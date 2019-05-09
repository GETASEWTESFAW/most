<?php

namespace App\Http\Middleware;

use Closure;

class NotificationRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      //dd($request->read);
        if($request->read) {
          $id=[];
          if($request->read != 'all'){
            $notification = $request->user()->notifications()->where('id', $request->read)->first();
            if($notification) {
               $id[]=$notification->data['requestId'];
                $notification->markAsRead();
                $notification->delete();
             }
           }
           else {
             $notifications = $request->user()->unreadNotifications()->get();

             foreach ($notifications as $notification) {
               $id[]=$notification->data['requestId'];
             }
             if($notifications) {
                 $notifications->markAsRead();
                 foreach ($notifications as $notification) {
                   $notification->delete();
                 }
              }
           }
       }
           $request->id=$id;
        return $next($request);
    }
}
