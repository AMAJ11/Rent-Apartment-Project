
    <main class="main" style="padding-top: 40px;">

   
            <header class="header">
                <h2>Dashboard</h2>

            </header>


            <section class="stats">
                <div class="stat-card">
                    <p>Users</p>
                    <h3> {{ $users->count() }}</h3>
                </div>

                <div class="stat-card">
                    <p>Bookings</p>
                    <h3> {{$appartments->count()}} </h3>
                </div>

                <div class="stat-card">
                    <p>Payments</p>
                    <h3>$12,450</h3>
                </div>

                <div class="stat-card">
                    <p>User Requests</p>
                    <h3> {{ $Temporaryusers->count() }} </h3>
                </div>
            </section>


            <section class="content">

                <div class="content-body">
                    <div class="content-header">
                        <h3>User Requests</h3>
                    </div>


                    <div class="activity">

                        <div class="activity-table">

                       
                            <div class="activity-row header">
                                <span>name</span>
                                <span>role</span>
                                <span>Status</span>
                                <span>Confirme</span>
                                <span>Delete</span>
                            </div>
                          
                             @foreach($Temporaryusers as $user)
    <form class="activity-row" method="POST" action="{{ url('acceptUser/' . $user->id) }}">
        @csrf <span class="name">{{ $user->first_name }}</span>
        <span class="user">{{ $user->role }}</span>
        <span class="status pending">Pending</span>

        <button type="submit" name="isAccept" value="1" class="icon-btn">✅</button>
        
        <button type="submit" name="isAccept" value="0" class="icon-btn">❌</button>
    </form>
@endforeach
                           

                        </div>

                    </div>



                </div>
            </section>

        </main>

    </div>