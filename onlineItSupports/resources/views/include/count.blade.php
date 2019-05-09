<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class=""> </i>Total Resolved by You
              <span class="label label-warning totalNotification" id="done-total">{{$total}}</span>
            </a>
            <ul class="dropdown-menu" >
              <li >
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="">
                  <li>
                    <table class="table">
                      <tr>
                        <td>Year</td><td><span class="badge" id="done-year">{{$year}}</span></td>
                      </tr>
                      <tr>
                        <td>Month</td><td> <span class="badge" id="done-month">{{$month}}</span></td>
                      </tr>
                      <tr>
                        <td>your self</td><td><span class="badge" id="done-yourself">{{$yourself}}</span></td>
                      </tr>
                      <tr>
                        <td>in group</td><td> <span class="badge" id="done-withteam">{{$withteam}}</span></td>
                      </tr>
                      <tr class="danger">
                        <td>Total</td><td><span class="badge" id="done-total">{{$total}}</span></td>
                      </tr>
                    </table>

                  </li>
                </ul>
              </li>
              <li class="footer "></li>
            </ul>
          </li>
