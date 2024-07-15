<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdinanceResource\Pages;
use App\Filament\Resources\OrdinanceResource\RelationManagers;
use App\Filament\Resources\Storage;
use App\Models\AuthorSponsor;
use App\Models\Ordinance;
use Blueprint\Contracts\Model;
use Filament\Actions\StaticAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section as SectionInfoList;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Entry;
use Filament\Infolists\Components\ViewEntry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\Support\HtmlString;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\HtmlString as SupportHtmlString;


class OrdinanceResource extends Resource 
{
    protected static ?string $model = Ordinance::class;
    protected static ?string $navigationLabel = 'Ordinance';
    // protected static ?string $modelTitle = 'Ordinance';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Ordinances & Resolution';
    protected static ?int $navigationSort = 2;
    protected string $view = 'filament.infolists.entries.view-file';

    // protected static ?string $recordTitleAttribute = 'series';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('author_id')
                    ->label('Author')
                    ->options(AuthorSponsor::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                    DatePicker::make('ord_date')
                    ->label('Date Approved')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->required(),
                ])->columns(2),
                Section::make()->schema([
                    TextInput::make('ord_no')->label('Ordinance No.'),
                    TextInput::make('series')
                    ->required(),
                ])->columns(2),
                    Section::make()->schema([
                    Textarea::make('subject')
                    ->rows(10)
                    ->cols(20)
                    ->required(),
                ]),
                Section::make()->schema([
                    FileUpload::make('file')
                    ->acceptedFileTypes(['application/pdf'])
                    ->preserveFilenames()
                    ->required()
                    ->enableOpen(),
                    
                ]),
                

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make( 'id')->searchable(),
                TextColumn::make('ord_no')->label('Ordinance No.')->searchable(),
                TextColumn::make('series')->label('Series Of.')->searchable(),
                TextColumn::make('subject')->wrap()->weight(FontWeight::SemiBold)->searchable(),
                TextColumn::make('author.name')->label('Author/Sponsor')->searchable(),
                TextColumn::make('ord_date')->label('Date Approved')->date()->searchable(),
                // SpatieMediaLibraryImageColumn::make('file'),

            ])
            ->filters([
                // Filter::make('Start Filter')
                // ->query(fn(Builder $query): Builder => $query->where('series', '1')),
                Filter::make('date')
                    ->form([
                        DatePicker::make('created_from')->label('Uploaded from'),
                        DatePicker::make('created_until')->label('Uploaded until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('ord_date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('ord_date', '<=', $date),
                            );
                    })
                

            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make()
            //     ->label('Add Ordinance')
            //     ->modalHeading('Add Ordinance')
            //     ->createAnother(false)
            //     ->closeModalByClickingAway(false),
            // ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('View More')
                ->icon('heroicon-o-document')
                ->hidden(fn(Ordinance $record): bool => in_array($record->mime, ['application/zip']))
                ->modalContent(fn(Ordinance $record): SupportHtmlString => new SupportHtmlString(
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
                // Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

        public static function infolist(Infolist $infolist): Infolist
        {
        return $infolist
            ->schema([
                SectionInfoList::make()
                    ->schema([
                        TextEntry::make('author.name')
                        ->label('Author/Sponsor'),
                        TextEntry::make('ord_date')
                        ->label('Approved Date')
                        ->date(),
                        
                    ])->columns(2),
                SectionInfoList::make()
                ->schema([
                    TextEntry::make('ord_no')->label('Approved Date'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrdinances::route('/'),
            'create' => Pages\CreateOrdinance::route('/create'),
            // 'view' => Pages\ViewOrdinance::route('/{record}'),
            // 'view-contact' => Pages\ViewOrdinance::route('/{record}/contact'),
            'edit' => Pages\EditOrdinance::route('/{record}/edit'),
        ];
    }

    // public static function getGlobalSearchResultDetails(Model $record): array
    // {
    //     return [
    //         'Resolution' => $record->resolution,
    //     ];
    // }
    
}
