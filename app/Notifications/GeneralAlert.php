<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class GeneralAlert extends Notification
{
    use Queueable;

    public $details;

    // Recibimos un array con: titulo, mensaje, nivel, link
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        // Guardamos en BD y enviamos por Mail
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        $level = $this->details['level'] ?? 'info'; // info, success, error

        $mail = (new MailMessage)
                    ->subject($this->details['title'])
                    ->greeting('Hola, ' . $notifiable->name)
                    ->line($this->details['message']);

        // Si hay un link, ponemos un botón
        if (isset($this->details['link'])) {
            $mail->action('Revisar ahora', $this->details['link']);
        }

        // Si es nivel error, Laravel pone el botón en rojo automáticamente
        if ($level === 'error') { $mail->error(); }

        return $mail;
    }

    // Esto es lo que se guarda en la tabla 'notifications' de la BD
    public function toArray($notifiable)
    {
        return [
            'title' => $this->details['title'],
            'message' => $this->details['message'],
            'level' => $this->details['level'] ?? 'info',
            'link' => $this->details['link'] ?? '#'
        ];
    }

    public function toDatabase($notifiable)
{
    // Este array es el que se convierte en JSON en tu tabla
    return [
        'title'   => $this->details['title'],
        'message' => $this->details['message'],
        'level'   => $this->details['level'] ?? 'info',
        'link'    => $this->details['link'] ?? '#',
    ];
}
}