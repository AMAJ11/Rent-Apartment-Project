<form method="POST" action="{{ url('/loginAdmin') }}">
    @csrf
    <input type="text" name="phone" placeholder="Phone Number" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login as Admin</button>
</form>