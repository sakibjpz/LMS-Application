<form action="{{ route('proceed.payment') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">
        Proceed to Payment
    </button>
</form>
