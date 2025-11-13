<?php

/**
 * This function fetches all of the cities in our database and prints them out in an HTML table
 * Note: this will be changed for later applications
 * @return void
 */
function generate_table () {
    $cities = get_all_cities();

    if(count($cities) > 0) {

        echo "<table class=\"table table-bordered table-hover\"> \n
                <thead> \n
                    <tr class=\"table-dark\"> \n
                        <th scope=\"col\">Trivia</th> \n
                    </tr> \n
                </thead> \n
              <tbody> \n";
            
        foreach($cities as $city) {
            extract($city);

            $capital = ($is_capital) ? '&starf;' : '';
        }

        echo "</tbody> \n
              </table> \n
              <aside> \n
              <h3 class=\"fs-5 fw-normal\">Notes</h3> \n
              <p class=\"text-muted my-3\">&starf; indicated the capital of a province or territory</p> \n
              <p class=\"text-muted my-3\">Hover over <i class=\"bi btn-info-circle\" data-bs-toggle=\"tooltip\" title=\"I'm a tooltip!\"><i> to see additional info about the city</i></p> \n
              </aside> \n";


    } else {
        echo "<h2 class=\"fw-light\">Oh No!</h2>";
        echo "<p>We're sorry, but we weren't able to find anything</p>";
    }
}

?>