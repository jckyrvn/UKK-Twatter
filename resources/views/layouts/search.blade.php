
<!-- bagian layout untuk di panggil di folder lain -->
<div class="searchbar">
<form action="{{ route('tweet/search') }}" method="POST">
    @csrf
    <input type="text" name="search" placeholder="Search" required/>
    <!-- <button type="submit">Search</button> -->
</form>

</div>