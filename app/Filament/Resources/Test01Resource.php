<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Test01Resource\Pages;
use App\Models\Test01;
use Filament\Forms\Components\Group as FormGroup;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\SelectColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Forms\Components\Section as FormSection;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Actions\Action;
use App\Filament\Resources\test01Resource\RelationManagers\UsersRelationManager;


class Test01Resource extends Resource
{
    protected static ?string $model = Test01::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $recordTitleAttribute = "bedrijfsNaam";

    public static function getGloballySearchableAttributes(): array
    {
        return ["bedrijfsNaam",];
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
            'Email' => $record->Email,
            'Phone' => $record->Phone,
            'Db' => $record->Db,
            'Status' => $record->Status,
        ];
    }

    public static function form(Form $form): Form
{
    return $form
        ->schema([

            FormSection::make('Algemeen')
                ->icon('heroicon-m-building-storefront')
                ->description('This is a test')
                ->columns(2)
                ->schema([
                    TextInput::make('debiteurnaam')
                        ->required()
                        ->maxLength(50),
                    TextInput::make("Bedrijf_user")
                        ->required(),

                    // Select::make('Bedrijf_user')
                    //     ->relationship('users', 'name')
                    //     ->searchable()
                    //     ->required(),

                    TextInput::make("Kvk")
                    ->label('kvk-nummer'),
                    TextInput::make("Btw")
                    ->label('Btw-nummer'),
                    TextInput::make("Db"),
                    Select::make('Status')
                    ->multiple()
                    ->searchable()
                    ->options([
                        'nieuwKlant' => 'Nieuw klant',
                        'nieuwAbonnee' => 'Nieuw Abonnee',
                        'klant' => 'Klant',
                        'abonnee' => 'Abonnee',
                        'opzegd' => 'Opzegd',
                        'leverancier' => 'Leverancier',
                        'reseller' => 'Reseller',
                        'zakelijkeKlant' => 'Zakelijke Klant',
                        'overige' => 'Overige',
                        'geenrelatie' => 'Geen Relatie',
                    ])
                    ->preload(),
                ]),

            FormSection::make('Contactpersonen')
                ->icon('heroicon-m-Phone')
                ->columns(2)
                ->schema([
                    TextInput::make('bedrijfsNaam'),
                    TextInput::make('Domain'),
                    TextInput::make('Email')
                        ->email(),
                    TextInput::make('Phone')
                        ->tel(),
                ]),
                FormGroup::make([
                    Repeater::make('inlogGegevens')
                        ->collapsible()
                        ->schema([
                            TextInput::make("InlogNaam")
                            ->label('URL'),
                            TextInput::make("UserName")
                            ->label('Username'),
                            TextInput::make("Password")
                            ->label('Password'),
                        ])
                        ->columns(1),
                ]),
                FormGroup::make([
                    Repeater::make('Note')
                        ->collapsible()
                        ->schema([
                            MarkdownEditor::make('Notes'),
                        ])
                        ->columns(1)
                ])
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->paginated([ 25, 50, 100, 'all'])
            ->columns([
                TextColumn::make('Db')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bedrijfsNaam')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make("Bedrijf_user")
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("Domain")
                    ->sortable()
                    ->copyable()
                    ->toggleable(),
                TextColumn::make("Email")
                    ->sortable()
                    ->copyable()
                    ->toggleable(),
                TextColumn::make("Phone")
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("kvk")
                    ->sortable()
                    ->label('kvk-nummer')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("btw")
                    ->sortable()
                    ->label('btw-nummer')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('Status')
                    ->sortable()
                    ->options([
                        'nieuwKlant' => 'Nieuw klant',
                        'nieuwAbonnee' => 'Nieuw Abonnee',
                        'klant' => 'Klant',
                        'abonnee' => 'Abonnee',
                        'opzegd' => 'Opzegd',
                        'leverancier' => 'Leverancier',
                        'reseller' => 'Reseller',
                        'zakelijkeKlant' => 'Zakelijke Klant',
                        'overige' => 'Overige',
                        'geenrelatie' => 'Geen Relatie',
                    ])
                    // ->beforeStateUpdated(function ($record, $state) {}) // Runs before the state is saved to the database.
                    // ->afterStateUpdated(function ($record, $state) {}) // Runs after the state is saved to the database.
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            ->Schema([
                Grid::make(1)
                    ->schema ([
                        Group::make([
                            Group::make([
                                InfolistSection::make('Algemeen')
                                ->icon('heroicon-m-building-storefront')
                                ->description('This a Description')
                                    ->schema([
                                        TextEntry::make('debiteurnaam'),
                                        TextEntry::make('Bedrijf_user'),
                                        TextEntry::make('Kvk')
                                        ->label('kvk-nummer'),
                                        TextEntry::make('Btw')
                                        ->label('btw-nummer'),
                                        TextEntry::make('Db'),
                                        TextEntry::make('Status'),
                                    ])
                            ]),
                            Group::make([
                                InfolistSection::make('Contactpersonen')
                                ->icon('heroicon-m-Phone')
                                ->description('This a Description')
                                    ->schema([
                                        TextEntry::make('bedrijfsNaam'),
                                        TextEntry::make('Domain'),
                                        TextEntry::make('Email'),
                                        TextEntry::make('Phone'),
                                    ]),
                                RepeatableEntry::make('Note')
                                ->schema([
                                    TextEntry::make('Notes'),
                                ])
                            ]),
                            Group::make([
                                RepeatableEntry::make('inlogGegevens')
                                    ->columns(1)
                                    ->schema([
                                        TextEntry::make('InlogNaam')
                                        ->label('URL')
                                        ->suffixAction(
                                            Action::make('copyCostToPrice')
                                                ->icon('heroicon-m-clipboard')
                                                ->action(function (Test01 $record) {
                                                    $record->Password;
                                                    $record->save();
                                                })
                                        )
                                        ,
                                        TextEntry::make('UserName')
                                        ->label('Username')
                                        ->suffixAction(
                                            Action::make('copyCostToPrice')
                                                ->icon('heroicon-m-clipboard')
                                                ->action(function (Test01 $record) {
                                                    $record->Password;
                                                    $record->save();
                                                })
                                        ),
                                        TextEntry::make('Password')
                                        ->label('Password')
                                        ->suffixAction(
                                            Action::make('copyCostToPrice')
                                                ->icon('heroicon-m-clipboard')
                                                ->action(function (Test01 $record) {
                                                    $record->Password;
                                                    $record->save();
                                                })
                                        )
                                        ,
                                    ])
                            ])
                        ])
                    ->columns(3),
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // UsersRelationManager::class,
            ];
    }



}
