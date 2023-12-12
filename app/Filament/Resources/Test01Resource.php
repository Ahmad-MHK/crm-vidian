<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Test01Resource\Pages;
use App\Filament\Resources\Test01Resource\RelationManagers;
use App\Models\Test01;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Group as FormGroup;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Forms\Components\Section as FormSection;
use Filament\Infolists\Components\Section as InfolistSection;
// use Filament\Infolists\Components\Split as InfolistSplit;
// use Filament\Tables\Columns\Layout\Split as TableColumnSplit;
use Filament\Infolists\Components\Group;
use Filament\Infolists;
use Filament\Infolists\Components\Actions\Action;
use Filament\Forms\Components\Radio;
use App\Filament\Resources\test01Resource\RelationManagers\UsersRelationManager;


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

            FormSection::make('Algemeen')
                ->icon('heroicon-m-building-storefront')
                ->description('This is a test')
                ->collapsible()
                ->columns(2)
                ->schema([
                    TextInput::make('debiteurnaam')
                        ->required()
                        ->maxLength(50),
                    // TextInput::make("Bedrijf_user")
                    //     ->required(),
                        Select::make('Bedrijf_user')
                        ->relationship('users', 'name')
                        ->searchable()
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

            FormSection::make('Contactpersonen')
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
                FormGroup::make([
                    Repeater::make('inlogGegevens')
                        ->collapsible()
                        ->schema([
                            TextInput::make("InlogNaam"),
                            TextInput::make("UserName"),
                            TextInput::make("Password")
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
                                ->collapsible()
                                // ->headerActions([
                                    // EditAction::make(),
                                // ])
                                    ->schema([
                                        TextEntry::make('debiteurnaam'),
                                        TextEntry::make('Bedrijf_user'),
                                        TextEntry::make('Kvk'),
                                        TextEntry::make('Btw'),
                                        TextEntry::make('Db'),
                                        TextEntry::make('Status'),
                                    ])
                            ]),
                            Group::make([
                                InfolistSection::make('Contactpersonen')
                                ->icon('heroicon-m-Phone')
                                ->description('This a Description')
                                ->collapsible()
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
                                        ->suffixAction(
                                            Action::make('copyCostToPrice')
                                                ->icon('heroicon-m-clipboard')
                                                ->action(function (Test01 $record) {
                                                    $record->Password;
                                                    $record->save();
                                                })
                                        ),
                                        TextEntry::make('Password')
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
            UsersRelationManager::class,
            ];
    }

}
