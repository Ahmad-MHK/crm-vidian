<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Test01Resource\Pages;
use App\Filament\Resources\Test01Resource\RelationManagers;
use App\Models\Test01;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Filament\Infolists\Components\Actions\Action;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;






class Test01Resource extends Resource
{
    protected static ?string $model = Test01::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $recordTitleAttribute = "bedrijfsNaam";

    public static function getGloballySearchableAttributes(): array
    {
        return ["bedrijfsNaam", "Bedrijf_user","Domain"];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return Test01Resource::getUrl('edit', ['record' => $record]);
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Bedrijf_user' => $record->Bedrijf_user,
            'Domain' => $record->Domain,
        ];
    }

    public static function form(Form $form): Form
{
    return $form
        ->schema([

            Section::make('Algemeen')
                ->icon('heroicon-m-building-storefront')
                ->description('This is a test')
                ->collapsible()
                // ->headerActions([
                //     EditAction::make()
                // ])
                // This is under development this is to Edit insade the info/view list
                ->columns(2)
                ->schema([
                    TextInput::make('debiteurnaam')
                        ->required()
                        ->maxLength(50),
                    TextInput::make("Bedrijf_user")
                        ->required(),
                    TextInput::make("Kvk"),
                    TextInput::make("Btw"),
                    TextInput::make("Db"),
                    Select::make('Status')
                    ->native(false)
                        ->options([
                            'draft' => 'Draft',
                            'reviewing' => 'Reviewing',
                            'published' => 'Published',
                        ]),
                ]),

            Section::make('Contactpersonen')
                ->icon('heroicon-m-Phone')
                ->collapsible()
                ->columns(2)
                ->schema([
                    TextInput::make('bedrijfsNaam'),
                    TextInput::make('Domain'),
                    TextInput::make('Email')
                        ->email(),
                    TextInput::make('Phone')
                        ->tel(),
            ]),

            Repeater::make('inlogGegevens')
                ->collapsible()
                ->schema([
                    TextInput::make("inlogGegevens.*.InlogNaam")
                    ->label('Inlog Naam')
                    ,
                    TextInput::make("inlogGegevens.*.UserName")
                        ->label('User Name')
                        // ->suffixAction(
                        //     Action::make('copyCostToPrice')
                        //         ->icon('heroicon-m-clipboard')
                        //         ->requiresConfirmation()
                        //         ->action(function (Test01 $record) {
                        //             $record->Username;
                        //             $record->save();
                        //         })
                        // )
                        ,
                    TextInput::make("inlogGegevens.*.Password")
                        ->label('Password')
                ])
                ->columns(1),

                Repeater::make('Note')
                    ->collapsible()
                    ->schema([
                        MarkdownEditor::make('Notes'),
                    ])
                    ->columns(1)

        ]);




}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Split::make([
                TextColumn::make('Db')
                ->sortable()
                ->searchable()
                ->toggleable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bedrijfsNaam')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make("Bedrijf_user")
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("Domain")
                ->copyable()
                ->toggleable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('Status')
                    ->options([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ])
                    ->toggleable(),
                    // ])->visibleFrom('md'),

                    // Panel::make([
                    //     Split::make([
                    //         TextColumn::make('Phone')
                    //             ->icon('heroicon-m-phone'),
                    //         TextColumn::make('Email')
                    //             ->icon('heroicon-m-envelope'),
                    //     ])->from('sm'),
                    // ])->collapsed()

                    // later developemnt for UserName and Password that u can get that from repeater and fet data every User


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListTest01s::route('/'),
            'create' => Pages\CreateTest01::route('/create'),
            'view' => Pages\ViewTest01::route('/{record}'),
            'edit' => Pages\EditTest01::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(3)
                    ->columnStart(1)
                    ->schema([
                        Section::make('Algemeen')
                            ->columns(1)
                            ->schema([
                                TextEntry::make('Bedrijf_user'),
                            ]),
                    ])
                    ->columnStart(2)
                    ->schema([
                        Section::make('Contactpersonen')
                            ->columns(1)
                            ->schema([
                                TextEntry::make('Phone'),
                            ]),
                    ])
                    ->columnStart(3)
                    ->schema([
                        RepeatableEntry::make('inlogGegevens')
                            ->columns(1)
                            ->schema([
                                TextEntry::make('InlogNaam')
                                    ->copyable()
                                    ->copyMessage('Copied!'),
                                TextEntry::make('UserName')
                                    ->copyable()
                                    ->copyMessage('Copied!'),
                                TextEntry::make('Password')  // Corrected field reference
                                    ->copyable()
                                    ->copyMessage('Copied!'),
                            ])

                    ]),
            ]);
    }



}
