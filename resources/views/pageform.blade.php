<div class="seiten">
  <form action="{{ url('home') }}" method="POST">
      @csrf
      @method('POST')
      <select id="seite" name="seite" class="seite" onchange="this.form.submit()">
          <option value="" disabled selected>reihen</option>
          <option value="5" {{ $totalRecordsPerPage == 5 ? 'selected' : '' }}>5</option>
          <option value="10" {{ $totalRecordsPerPage == 10 ? 'selected' : '' }}>10</option>
          <option value="15" {{ $totalRecordsPerPage == 15 ? 'selected' : '' }}>15</option>
          <option value="20" {{ $totalRecordsPerPage == 20 ? 'selected' : '' }}>20</option>
          <option value="25" {{ $totalRecordsPerPage == 25 ? 'selected' : '' }}>25</option>
          <option value="30" {{ $totalRecordsPerPage == 30 ? 'selected' : '' }}>30</option>
      </select>
  </form>
</div>
{{-- {{ $total_records_per_page == 5 ? 'selected' : '' }} --}}