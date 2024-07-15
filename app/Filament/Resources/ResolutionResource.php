<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResolutionResource\Pages;
use App\Filament\Resources\ResolutionResource\RelationManagers;
use App\Models\AuthorSponsor;
use App\Models\Resolution;
use Filament\Actions\StaticAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString as SupportHtmlString;
use Filament\Infolists\Components\Section as SectionInfoList;
use Filament\Infolists\Components\TextEntry;

class ResolutionResource extends Resource
{
    protected static ?string $model = Resolution::class;

    protected static ?string $navigationLabel = 'Resolution';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Ordinances & Resolution';
    protected static ?int $navigationSort = 1;
    
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('author_id')
                    ->relationship(name: 'author', titleAttribute: 'name')
                    ->label('Author')
                    ->options(AuthorSponsor::all()->pluck('name', 'id'))
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ])
                    ->searchable(),
                    TextInput::make('committee_in_charge')->label('Committee In Charge'),
                    // TextInput::make('author_sponsor')->label('Author/Sponsor'),
                    DatePicker::make('res_date')->label('Date Approved')->native(false)->displayFormat('d/m/Y'),
                ])->columns(3),
                Section::make()->schema([
                    TextInput::make('res_no')->label('Resolution No.'),
                    TextInput::make('series'),
                ])->columns(2),
                    Section::make()->schema([
                    Textarea::make('subject')->autosize(),
                ]),
                Section::make()->schema([
                    FileUpload::make('file')
                    ->acceptedFileTypes(['application/pdf'])
                    ->preserveFilenames()
                    ->enableOpen(),
                    // ->enableDownload(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('res_no')->label('Resolution No.')->searchable(),
                TextColumn::make('series')->label('Series Of.')->searchable(),
                TextColumn::make('subject')->wrap()->weight(FontWeight::SemiBold)->searchable(),
                TextColumn::make('committee_in_charge')->label('Committee In Charge')->searchable(),
                TextColumn::make('author.name')->label('Author/Sponsor')->searchable(),
                TextColumn::make('res_date')->label('Date Approved')->date()->searchable(),
            ])
            ->filters([
                Filter::make('date')
                    ->form([
                        DatePicker::make('created_from')->label('Uploaded from'),
                        DatePicker::make('created_until')->label('Uploaded until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('res_date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('res_date', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('View More')
                ->icon('heroicon-o-document')
                ->hidden(fn(Resolution $record): bool => in_array($record->mime, ['application/zip']))
                ->modalContent(fn(Resolution $record): SupportHtmlString => new SupportHtmlString(
                        '<iframe src="' . asset('storage/' . $record->file). '" width="100%" height="600px"></iframe>' ))
                ->modalWidth(MaxWidth::SevenExtraLarge)
                ->requiresConfirmation(false)
                ->modalSubmitAction(false)
                ->modalFooterActionsAlignment('right')
                ->modalCancelAction(fn(StaticAction $action) => $action ->label('Close')->color('primary')),
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
            'index' => Pages\ListResolutions::route('/'),
            'create' => Pages\CreateResolution::route('/create'),
            // 'view' => Pages\ViewResolution::route('/{record}'),
            'edit' => Pages\EditResolution::route('/{record}/edit'),
        ];
    }
    
    public static function infolist(Infolist $infolist): Infolist
    {
    return $infolist
        ->schema([
            SectionInfoList::make()
                ->schema([
                    TextEntry::make('author.name')
                    ->label('Author/Sponsor'),
                    TextEntry::make('committee_in_charge')
                    ->label('Committee In Charge'),
                    TextEntry::make('res_date')
                    ->label('Approved Date')
                    ->date(),
                    
                ])->columns(3),
            SectionInfoList::make()
            ->schema([
                TextEntry::make('res_no')->label('Resolution No.'),
                TextEntry::make('series')->label('Series Of.'),
                
            ])->columns(2),
            SectionInfoList::make()
                ->schema([
                    TextEntry::make('subject')->weight(FontWeight::SemiBold),
                ]),
                // SectionInfoList::make()
                // ->schema([
                //     ImageEntry::make('file'),
                // ]),
                // SectionInfoList::make()
                // ->schema([
                //     ViewEntry::make('file')
                //     ->label('')
                //     ->view('infolists.components.view-file'),
                // ]),
                
        ]);
    }
}
