<script src="search.js"></script>
<div id="search">
    <h4>Search: Sort:</h4><br>
    <form method="post" action="searchResults.php" onload="changeSearch();">
        <select name = "selectSearch" id="selectSearch" onchange="changeSearch();">
           <option value="suburb">Suburb</option>
            <option value="distance">Close to me</option>
            <option value="name">Name</option>
    </select> 
    <input name = "suburb" id="suburb" style="display:inline" type="text" placeholder="E.g. Toowong">
    <select name = "dist" id="distance" style="display:none">
      <option value="1">&#60; 1km</option>
      <option value="2">&#60; 5km</option>
      <option value="3">&#60; 10km</option>
      <option value="4">&#62; 10km</option>
    </select>
    <input name = "query" id="name" style="display:none" type="text" placeholder=" E.g. Ada Street Park">
    <select name = "sort" id="sortSearch">
      <option value="a-z">Alphabetically: A-Z</option>
      <option value="z-a">Alphabetically: Z-A</option>
      <option value="closest">Distance: closest to me</option>
      <option value="furthest">Distance: furthest from me</option>
      <option value="ratingH">Rating: highest to lowest</option>
      <option value="ratingL">Rating: lowest to highest</option>
    </select>
    <select name = "rating" id="rating" style="display:none">
      <option value="1">Highest to lowest</option>
      <option value="2">Lowest to highest</option>
    </select>
	<input name="lat" style="display:none">
	<input name="long" style="display:none">
    <button type="submit">Search</button>
  </form>
</div>