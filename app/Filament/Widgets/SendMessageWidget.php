<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms;
use App\Models\User;
use App\Traits\SendMessages;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use App\Service\TelegramBotService;

use Telegram\Bot\Api as TelegramApi;


class SendMessageWidget extends Widget implements HasForms
{
    use SendMessages;
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.send-message-widget';

    public $message;
    public $selected_user;
    public $telegrambot;


    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Textarea::make('message')
            ->label('Message')
            ->required()
            ->rows(4),
                Forms\Components\Select::make('selected_user')
                ->label('Select User')
                ->options(User::all()->mapWithKeys(function ($user) {
                    return [$user->tg_id => $user->email . ' (' . $user->tg_id . ')'];
                }))
                ->searchable()
                ->required(),
        ];
    }

    public function sendMessage()
    {
        $this->telegrambot = new TelegramApi();

        $data = $this->form->getState();

        $bot = new TelegramBotService($this->telegrambot);
        // info($data['selected_user']);
        // info($data['message']);
        $bot->sendMessage($data['selected_user'], $data['message']);


        // $this->sendMessageToUser($data['selected_user'], $data['message']);

        $this->form->fill();

        $this->notify('success', 'Message sent successfully');
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function getFormModel(): string
    {
        return static::class;
    }
}