<?php

namespace App\Filament\Resources\ReferralEarningRequestResource\Pages;

use App\Filament\Resources\ReferralEarningRequestResource;
use App\Models\ReferralEarningRequest;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditReferralEarningRequest extends EditRecord
{
    protected static string $resource = ReferralEarningRequestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mount($record): void
    {
        $this->record = ReferralEarningRequest::with('user.wallet')->findOrFail($record);

        $this->form->fill([
            'user_id' => $this->record->user_id,
            'usdt_address' => $this->record->usdt_address,
            'status' => $this->record->status,

            'referral_balance' =>  $this->record->user->wallet->referral_balance,

            // ... other fields ...
        ]);
    

        // Debugging here
        Log::debug("Edit form mounted for record: " . print_r($this->record->toArray(), true));

    }
}
