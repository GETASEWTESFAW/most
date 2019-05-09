<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning totalNotification" id="totalNotification">{{auth()->user()->unreadNotifications()->count()}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header ">You have <span class="totalNotification">{{auth()->user()->unreadNotifications()->count()}}</span> unread notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notificationMenu">
                  @foreach(auth()->user()->unreadNotifications()->get() as $notification)
                  <li>
                    <a href="{{url('/readNotification',$notification->id)}}">
                      <div class="">
                    sender: {{$notification->data['firstName']}} {{$notification->data['middleName']}}
                    </div>

                  <div class="title">
                  Request Type: {{$notification->data['requestTitle']}}
                  </div>
                  <div class="message">
                  Message:{{$notification->data['requestMessage']}}
                  </div>
                  <div class="date">
                    date: {{$notification->data['sendTime']['date']}}
                  </div>
                </a>
                  </li>
                   @endforeach
                </ul>
              </li>
              <li class="footer"><a href="{{url('/readNotification','all')}}">View all</a></li>
            </ul>
          </li>
