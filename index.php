<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pokédex</title>
        <style>
            html, body
            {                
                font-size: 4px;
                min-height: 100%;
            }

            body
            {            
                padding: 0;
                margin: 0;                
                font-family: Calibri;
                background-color: rgb(51, 51, 51);                
            }
            
            #content
            {
                width: 1024px;
                background-color: white;                
                margin: auto;
                padding: 2% 0 4% 0;
                text-align: center;
            }
            
            #cabecalho
            {
                width: 100%;                                               
                margin: auto;
                padding-bottom: 2%;                
            }
            
            #cabecalho img
            {
                width: 50%;
                margin: 0;
            }
                                   
            #filtros-1
            {
                width: 100%;
                height: 20rem;                              
                margin: auto;               
                background-color: rgb(51, 51, 51);
            }
            
            #filtros-2
            {
                width: 100%;
                height: 20rem;                           
                margin: auto;
                margin-bottom: 6%;
                background-color: rgb(150, 150, 150);
            }
            
            #pokemons
            {
                width: 100%;                             
                margin: 0;
                margin: auto;                
            }
            
            #load-pokemons
            {
                padding: 2% 4% 2% 4%;
                background-color: rgb(0, 102, 255);
                border: none;
                color: white;
                font-size: 5rem;
                border-radius: 2rem;
                cursor: pointer;
                display: block;
                margin: auto;
            }
            
            #load-pokemons:hover
            {
                background-color: rgb(0, 92, 153);
            }
            
            #load-pokemons:focus
            {
                border: none;
                outline: none;
            }
            
            #load-gif
            {
                width: 20%;
                margin: 0;
                display: none;
                margin-top: -5%;
            }
                                              
            .pokemon
            {
                display: inline-table;
                width: 20%;   
                text-align: left;
                padding: 0 1% 6% 1%;
            }
                                            
            .pokemon img
            {
                width: 100%;
                background-color: rgb(235, 235, 235);
                border-radius: 1rem;
            }
            
            .pokemon p
            {
                margin: 0 0 4% 0;
                font-size: 4rem;
                color: rgb(128, 128, 128);
                text-align: left;
                font-weight: bold;
            }
            
            .pokemon h2
            {
                font-size: 8rem;
                color: rgb(51, 51, 51);
                margin: 0 0 2% 0;
                text-align: left;
            }
            
            .pokemon-type
            {
                width: 20%;                
                background-color: white;
                font-size: 3rem;
                padding: 2% 8% 2% 8%;
                border-radius: 4px;
                line-height: 1;
                vertical-align: middle;
                display: inline-block;
                margin: 0 2% 0 0;  
                text-align: center;                
            }
            
        </style>
        
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        
        <script>
            
            pokemons_arr = [];            
            index = 1;
            
            function getPokemon(id) 
            {                
                $.post("controllers/PokemonController.php",
                {
                  acao: "getPokemon",
                  id: id
                },
                function(data, status){
                    var pokemon = JSON.parse(data); 
                   
                    var types = "";
                        
                    pokemon.types.forEach(function(type)
                    {                            
                        
                        
                        types = types.concat("<div class='pokemon-type'>" + type + "</div>");                       
                    });    
                                     
                   $("#pokemons").append("<div class='pokemon'><img src='" + pokemon.img + "' alt=''><p>Nº " + pokemon.number + "</p><h2>" + pokemon.name + "</h2>" + types + "</div>");
                });                
            }
            
            function getNext12(start_id) 
            {     
                $("#load-pokemons").hide();
                $("#load-gif").show();
                
                $.post("controllers/PokemonController.php",
                {
                  acao: "getNext12",
                  start_id: start_id
                },
                function(data)
                {
                    var pokemons = JSON.parse(data);
                    
                    pokemons.forEach(function(pokemon)
                    {
                        pokemons_arr.push(pokemon);                     
                    });
                    
                    index += pokemons.length;
                    
                    showPokemons();
                    
                    $("#load-pokemons").show();
                    $("#load-gif").hide();
                });            
            }
            
            function showPokemons()
            {
                //pokemons_arr.sort(compareAZ);
                
                $("#pokemons").html("");
                
                pokemons_arr.forEach(function(pokemon)
                {
                    var types = "";
                    pokemon.types.forEach(function(type)
                    {   
                        switch(type) 
                        {
                            case 'Grass':
                                types = types.concat("<div class='pokemon-type' style='background-color: #88cc00; color: black'>" + type + "</div>");
                                break;
                            case 'Water':
                                types = types.concat("<div class='pokemon-type' style='background-color: #3399ff; color: white'>" + type + "</div>");
                                break;
                            case 'Poison':
                                types = types.concat("<div class='pokemon-type' style='background-color: #9966ff; color: white'>" + type + "</div>");
                                break;
                            case 'Fire':
                                types = types.concat("<div class='pokemon-type' style='background-color: #ff6600; color: white'>" + type + "</div>");
                                break;
                            case 'Flying':
                                types = types.concat("<div class='pokemon-type' style='background-color: #66ffff; color: black'>" + type + "</div>");
                                break;
                            case 'Bug':
                                types = types.concat("<div class='pokemon-type' style='background-color: #339933; color: white'>" + type + "</div>");
                                break;
                            case 'Normal':
                                types = types.concat("<div class='pokemon-type' style='background-color: #bfbfbf; color: black'>" + type + "</div>");
                                break;
                            case 'Electric':
                                types = types.concat("<div class='pokemon-type' style='background-color: #ffcc00; color: black'>" + type + "</div>");
                                break;
                            case 'Ground':
                                types = types.concat("<div class='pokemon-type' style='background-color: #cc9900; color: black'>" + type + "</div>");
                                break;
                            case 'Fairy':
                                types = types.concat("<div class='pokemon-type' style='background-color: #ffcccc; color: black'>" + type + "</div>");
                                break;
                            default:
                                types = types.concat("<div class='pokemon-type'>" + type + "</div>");
                        }                                               
                    });
                    
                    console.log(pokemon.name);
                    
                    $("#pokemons").append("<div class='pokemon'><img src='" + pokemon.img + "' alt=''><p>Nº " + pokemon.number + "</p><h2>" + pokemon.name + "</h2>" + types + "</div>");
                });
            }
            
            function compareAZ(a, b)
            {
                return a.name.localeCompare(b.name);
            }
            
            function compareZA(a, b)
            {
                return b.name.localeCompare(a.name);
            }
            
            $(document).ready(function(){
                $("#load-pokemons").click(function(){
                    getNext12(index);
                });
                
                getNext12(index);
            });
                      
        </script>
        
    </head>
    <body>
        <div id="content">   
            <div id="cabecalho">
                <img src="img/pokedex-logo.png" alt="">
            </div>            
            <div id="filtros-1"></div>
            <div id="filtros-2"></div>
            <div id="pokemons"></div>
            <input type="button" id="load-pokemons" value="Carregar mais Pokémons!">
            <img id="load-gif" src="https://icon-library.com/images/loading-icon-animated-gif/loading-icon-animated-gif-15.jpg" alt="">
        </div>
    </body>
</html>
