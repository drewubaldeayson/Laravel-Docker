<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserIndividualRepositoryInterface;
use App\Contracts\UserVerificationRepositoryInterface;

class DeleteUnverifiedUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        UserRepositoryInterface $user, 
        UserIndividualRepositoryInterface $userIndividual,
        UserVerificationRepositoryInterface $userVerification)
    {
        $userIndividualItem = $userIndividual->findByCustomWhere(['user_id' => $this->user_id]);
        if($userIndividualItem){
            if ($userIndividualItem->status == 'pending') {
                $userVerificationItem = $userVerification->findByCustomWhere(['user_id' => $this->user_id]);
                $deletedIndividual = $userIndividualItem->delete();
                $deletedVerification = $userVerificationItem->delete();
                $deletedUser = $user->delete($this->user_id);
            }
        }
    }
}
