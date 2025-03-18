<?php

namespace App\Mail;

use App\Models\Anggota;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovePendaftaran extends Mailable
{
    use Queueable, SerializesModels;

    public $anggota;
    public $token;
    /**
     * Create a new message instance.
     */
    public function __construct(Anggota $anggota, $token)
    {
        //
        $this->anggota = $anggota;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Approve Pendaftaran',
        );
    }

    public function build()
    {
        return $this->subject('Pendaftaran Anda Diterima')
                    ->view('mail.terima')
                    ->with([
                        'nama' => $this->anggota->nama,
                        'link_aktivasi' => route('anggota-aktivasi', ['token' => $this->token, 'email' => $this->anggota->email]),
                    ]);
    }
   

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
