<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Test01Resource\Pages;
use App\Filament\Resources\Test01Resource\RelationManagers;
use App\Models\Test01;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Filament\Infolists\Components\Actions\Action;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Forms\Components\Repeater;

class Test01Resource extends Resource
{
    protected static ?string $model = Test01::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $recordTitleAttribute = "bedrijfsNaam";

    // public static function getGloballySearchableAttributes(): array
    // {
    //     return ["bedrijfsNaam", "Bedrijf_user","Domain"];
    // }

    // public static function getGlobalSearchResultUrl(Model $record): string
    // {
    //     return Test01Resource::getUrl('edit', ['record' => $record]);
    // }

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

            Section::make()
                ->icon('heroicon-m-building-storefront')
                ->description('This is a test')
                ->collapsible()
                // ->headerActions([
                //     EditAction::make()
                // ])
                // This is under development this is to Edit insade the info/view list
                ->columns(2)
                ->schema([
                    TextInput::make('bedrijfsNaam')
                        ->required()
                        ->maxLength(50),
                    TextInput::make("Bedrijf_user")
                        ->required(),
                    TextInput::make("Kvk"),
                    TextInput::make("Btw"),
                    TextInput::make("Db"),
                ]),

            Section::make()
                ->collapsible()
                ->columns(2)
                ->schema([
                    // TextInput::make('bedrijfsNaam'),
                    TextInput::make('debiteurnaam'),
                    TextInput::make('Domein'),
                    TextInput::make('Email')
                        ->email(),
                    TextInput::make('Phone')
                        ->tel(),
            ]),

            Repeater::make('WordPress')
                ->collapsible()
                ->schema([
                    TextInput::make("WordPress.*.UserName")
                        ->label('User Name'),
                    TextInput::make("WordPress.*.Password")
                        ->label('Password')
                ])
                ->columns(1)

            ]);
}



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make("Bedrijf_user"),
                TextColumn::make("Domain"),
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
}
