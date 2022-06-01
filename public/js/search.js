$(document).ready(function(){
  
    // hide search results on clicking anywhere else
    $('html').click(function(){
        $('#search-result').hide();
    });

    // on click SEARCH button
    $('button.search-btn').on('click',function(e) {
        
        // clear results
        $('#search-result').html("");

        // Take the value of the search field
        var searchInput = $('input.search').val();
        
        // fetch data
        $.ajax({
            type : 'get',
            url : 'http://localhost/search',
            data:{'search':searchInput},
            success:function(data){
                console.log(data);
                $('#search-result').append(data);

                // show results if not empty
                if($('#search-result').html() != ""){
                    $('#search-result').show();
                }
            }
        });
            
    });
});