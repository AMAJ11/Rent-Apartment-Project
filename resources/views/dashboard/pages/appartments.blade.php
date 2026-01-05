<main class="main" style="padding-top: 40px;">

    <div class="page-header">
        <h2>All Properties</h2>
    </div>

    <div class="cards">


        @foreach($apartments as $appartment)
            <div class="property-card">
                <div class="card-image">
<img src="{{ asset('storage/' . ($images[$appartment->id] ?? 'default.jpg')) }}">                    <form method="POST" action="{{ url('deleteApartment/' . $appartment->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" type="submit" onclick="return confirm('Are you sure you want to delete this property?')">🗑️</button>
                    </form>
                </div>
                <div class="card-body">
                    <h3 style="color: rgb(2, 53, 28);border: 1px solid green;width: 100%; padding: 5px 20px;border-radius: 20px;background-color: #a09e9e; ">
                        {{ $appartment->description }}</h3>
                    <p class="city">{{ $appartment->city }}</p>
                    <p class="price">${{ $appartment->price_for_month }} / month</p>
                </div>
            </div>
        @endforeach
    </div>
 


</main>
<style>
    .page-header {
        margin-bottom: 20px;
    }

    .cards {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    }

    .property-card {
        background: #025a27;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform .2s ease;
        width: 24%;
        max-height: 500px;
    }

    .property-card:hover {
        transform: translateY(-4px);
    }

    .card-image {
        position: relative;
        height: 200px;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .delete-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        border: none;
        width: 32px;
        text-align: center;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .delete-btn:hover {
        background: #c0392b;
    }

    .card-body {
        padding: 14px;
    }

    .card-body h3 {
        font-size: 16px;
        margin: 0 0 6px;
    }
.card-body h3{
     height: 5rem;
     overflow-y: hidden;
}
.card-body h3:hover{
    overflow: auto;
}
    .city {
        color: #777;
        font-size: 14px;
    }

    .price {
        margin-top: 8px;
        font-weight: bold;
    }
</style>