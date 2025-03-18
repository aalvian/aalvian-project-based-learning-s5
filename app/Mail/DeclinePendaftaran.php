<?php

namespace App\Mail;

use App\Models\Anggota;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeclinePendaftaran extends Mailable
{
    use Queueable, SerializesModels;

    public $anggota;
    /**
     * Create a new message instance.
     */
    public function __construct(Anggota $anggota)
    {
        //
        $this->anggota = $anggota;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Decline Pendaftaran',
        );
    }

    public function build()
    {
        return $this->subject('Pendaftaran Anda Ditolak')
                    ->view('mail.tolak')
                    ->with([
                        'nama' => $this->anggota->nama,
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
