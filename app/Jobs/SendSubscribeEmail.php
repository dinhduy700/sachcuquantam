<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\SubscribeNews;
use App\Mail\SubscribeProduct;
use App\Models\News;
use App\Models\Product;
use App\Models\Subscribe;

class SendSubscribeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $type;

    public $timeout = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->type == 1 ? Product::find($this->id) : News::find($this->id);
        $subscribes = Subscribe::where('is_active', 1)->get();
        if (count($subscribes) > 0) {
            foreach ($subscribes as $subscribe) {
                Mail::to($subscribe->email)->send($this->type == 1 ? new SubscribeProduct($data, $subscribe->email) : new SubscribeNews($data, $subscribe->email));
                sleep(30);
            }
        }
    }
}
