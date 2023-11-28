<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Test01Resource\Pages;
use App\Filament\Resources\Test01Resource\RelationManagers;
use App\Models\Test01;
use Filament\Forms;
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

class Test01Resource extends Resource
{
    protected static ?string $model = Test01::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = "name";

    // public static function getGloballySearchableAttributes(): array
    // {
    //     return ["name", "Bedrijf_user","Domain"];
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
                TextInput::make('name')
                    ->required()
                    ->maxLength(50),
                TextInput::make("Bedrijf_user")
                    ->required(),
                TextInput::make("Domain")
                    ->required(),
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
