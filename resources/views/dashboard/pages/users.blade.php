<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="DashboardITEproject.css" />
</head>

<body>
    <div>
        <main class="main" style="padding-top: 40px;">

            <header class="header">
                <h2>All Users</h2>

            </header>

            <div class="content-body">

                <div class="activity">

                    <div class="activity-table">

                        <div class="activity-row header">
                            <span>Id</span>
                            <span>ِAvatar</span>
                            <span>User name</span>
                            <span>Wallets</span>
                            <span>Delete</span>
                        </div>

   @foreach($users as $user)
    <div class="user-item-wrapper" style="border-bottom: 1px solid #eee; padding: 10px;">
        <form class="activity-row" method="POST" action="{{ url('deleteUser/' . $user->id) }}">
            @csrf 
            @method('DELETE') 
            <span class="name">{{ $user->id }}</span>
            <span>
                <img src="{{ $user->profile_image }}" style="width: 50px; border-radius: 50%;" alt="">
            </span>
            <span class="username">{{ $user->first_name }}</span>
            <span class="wallets">
                {{ $user->balance }}
                @if($user->role == 'tenant')
                    <button type="button" class="add-balance-btn" onclick="toggleBalanceForm({{ $user->id }})">+</button>
                @endif
            </span>
            
            <button class="icon-btn" type="submit" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">❌</button>
        </form>

        {{-- تم نقل الكود إلى هنا ليكون داخل الـ foreach --}}
        @if($user->role == 'tenant')
            <div id="form-balance-{{ $user->id }}" style="display: none; margin-top: 10px; background: #f9f9f9; padding: 10px; border: 1px solid #ccc;">
                <form method="POST" action="{{ url('increaseBalance/' . $user->id) }}">
                    @csrf
                    <input type="number" name="amount" placeholder="أدخل المبلغ" required step="0.01">
                    <button type="submit" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">موافق</button>
                    <button type="button" onclick="toggleBalanceForm({{ $user->id }})" style="padding: 5px 10px; cursor: pointer;">إلغاء</button>
                </form>
            </div>
        @endif
    </div>
@endforeach 

                    </div>
        </main>
    </div>
</body>

</html>