<?php

namespace App\Notifications;

use App\Models\Answer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnwserCreatedNotification extends Notification
{
    use Queueable;

    protected $answer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' , 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('New Answer'))
                    ->greeting(__('Hello , :name',['name' => $notifiable->name]))

                    ->line(__('A new Answer has been created (Question #:question)',
                    ['question'=>$this->answer->question->title]))

                    ->action('View Question', url('user/question/'.$this->answer->question_id))

                    ->line(__('l hope to be a correct answer.'));
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'User'   => __('New Answer for :user',['question' => $this->answer->question->user->name]),
            'title'  => __('New Answer for (:question)',['question' => $this->answer->question->title]),
            'man'    => $this->answer->user->name,
            'answer' => $this->answer->content,
            'icon'   => $this->answer->user->profile->image,
            'url'    => url('user/question/'.$this->answer->question_id),
            'time'   => '',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
