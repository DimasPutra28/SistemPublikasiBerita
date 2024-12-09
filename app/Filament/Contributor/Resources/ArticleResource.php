<?php

namespace App\Filament\Contributor\Resources;

use App\Filament\Contributor\Resources\ArticleResource\Pages;
use App\Filament\Contributor\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Main Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->debounce(500)
                            ->afterStateUpdated(fn($operation, Forms\Set $set, ?string $state) => $operation === 'edit' ? null : $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->readOnly(),
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->fileAttachmentsDirectory('articles/images')->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make('Meta Information')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->preload(true)
                            ->createOptionForm(fn() => [
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->unique()
                                    ->maxLength(255),
                            ])
                            ->searchable(),
                        Forms\Components\Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload(true)
                            ->createOptionForm(fn() => [
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->unique()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\TextInput::make('meta_description')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sumber')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('articles/thumbnails')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('excerpt')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('is_published')
                    ->label('Status Publish')
                    ->color(fn($record) => $record->is_published == true ? 'success' : 'danger')
                    ->getStateUsing(fn($record) => $record->is_published == true ? 'Publish' : 'Draft')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\ToggleColumn::make('is_published')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->visible(fn($record) => $record ? $record->is_published : false)
                    ->dateTime('d M Y')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('published')
                    ->query(fn(Builder $query) => $query->where('is_published', true)),
                Tables\Filters\Filter::make('unpublished')
                    ->query(fn(Builder $query) => $query->where('is_published', false)),
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn($record) => $record ? $record->is_published == false : true),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn($record) => $record ? $record->is_published == false : true),
            ]);
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
        // ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
