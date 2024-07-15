<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UauthorResource\Pages;
use App\Filament\Resources\UauthorResource\RelationManagers;
use App\Models\AuthorSponsor;
use App\Models\Uauthor;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UauthorResource extends Resource
{
    protected static ?string $model = AuthorSponsor::class;
    protected static ?string $navigationLabel = 'Author & Sponsor';
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Authors & Sponsors';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('name')
                ->autosize()
                ->unique(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->searchable(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
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
            'index' => Pages\ListUauthors::route('/'),
            'create' => Pages\CreateUauthor::route('/create'),
            'edit' => Pages\EditUauthor::route('/{record}/edit'),
        ];
    }
}
