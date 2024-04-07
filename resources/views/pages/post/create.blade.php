<div class="container">
    <form action="https://httpbin.org/post" method="post">
      <div class="form-group">
        <label for="name">Display name</label>
        <input id="name" name="name" type="text">
      </div>
      <div class="form-group">
        <label for="location">Location</label>
        <input id="location" name="location" type="text">
      </div>
      <div class="form-group">
        <label>About me</label>
        <div id="editor"></div>
      </div>
      <button type="submit">Submit Form</button>
      <button type="button" id="resetForm">Reset to Initial Data</button>
    </form>
  </div>


@push('scripts')
<script>

</script>

@endpush
