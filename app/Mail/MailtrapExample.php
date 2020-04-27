<?php
namespace App\Mail;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class MailtrapExample extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $request;
    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->request->type == 'contact'){
            return $this->subject('Contact Us')
                ->markdown('contact_email')
                ->with([
                    'name' => $this->request->name,
                    'message'=>$this->request->message,
                    'email'=>$this->request->email,
                    'contact' =>$this->request->contact,
                    'type'=>'contact'
                ]);
        }
        else{
            return $this->subject('Support')
                ->markdown('contact_email')
                ->with([
                    'name' => $this->request->name,
                    'message'=>$this->request->message,
                    'email'=>$this->request->email,
                    'contact' =>$this->request->contact,
                    'type'=>'support'
                ]);
        }

    }
}
