<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewClassroomNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail', 'broadcast'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        $content = __(':name posted a new :type: :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => $classwork->title,
        ]);

        return (new MailMessage)
            ->subject(__('New :type', [
                'type' => $classwork->type->value,
            ]))
            ->greeting(__('Hi :name', [
                'name' => $notifiable->name,
            ]))
            ->line('The introduction to the notification.')
            ->action(__('Go To classwork'), route('classrooms.classworks.show', [$classwork->classroom_id, $classwork->id]))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(): DatabaseMessage
    {
        return new DatabaseMessage($this->createMessage());
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->createMessage());
    }

    protected function createMessage(): array
    {
        $classwork = $this->classwork;
        $content = __(':name posted a new :type: :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => $classwork->title,
        ]);
        return ['title' => __('New :type', [
            'type' => $classwork->type->value
        ]),
            'body' => $content,
            'image' => '',
            'link' => route('classrooms.classworks.show', [$classwork->classroom_id, $classwork->id]),
            'classwork_id' => $classwork->id
        ];
    }
}
