<?php
/*
Devise a function that gets one parameter 'w' and returns all the anagrams for 'w' from the file
wl.txt.

"Anagram": An anagram is a type of word play, the result of rearranging the letters of a word or
phrase to produce a new word or phrase, using all the original letters exactly once; for example
orchestra can be rearranged into carthorse.

anagrams("horse") should return:
['heros', 'horse', 'shore']

*/



$word = $_REQUEST['word'];

$array_word = array();

$array_word[] = $word;

function getAnagram($qtd= 0){
    global $array_word;

    if(count( $array_word ) > $qtd){
        $word = $array_word[$qtd];
    }else{
        $word = '';
    }

    if( strlen($word) )
    {
        $word_array = str_split($word);
        
        for($i = 0; $i < strlen($word); $i++ ){
            $letra = $word_array[$i];
            
            for ($k = 0; $k < strlen($word); $k++) {
                $palavra_array = $word_array;
            
                $palavra_array[$k] = $letra;
                $palavra_array[$i] =$word_array[$k];

                $palavra = implode($palavra_array); 
                
                
                if(!in_array($palavra, $array_word)){
                    $array_word[] = $palavra;
                }
                    

            }
            
        }
       
        getAnagram( ++$qtd );
    }else{
        return false;
    }
}
getAnagram(0);


$file = fopen("wl.txt", 'r+');
function recurRead($word, $times = 0, $max = 0){

    global $array_word, $file;
    // echo "Looking for  $word <hr>";

    rewind($file);
    $linha = 0;
    if($file){
        while (!feof($file)) {
            $linha++;
            $line = fgets($file, 4096);
            //if( !( strpos($line,$word) === false  ) ){
            if( strtolower( trim( $line ) ) == strtolower($word) ){

                echo $line.' = '.$word.' na linha '.$linha.' repeticao: '.$times.'<br />';
            }
        }
    }
    
    
    $times ++;
    if( isset($array_word[$times]) ){
        

        recurRead( $array_word[$times] , $times, count($array_word) );
    }

}

if( count($array_word) ){
    echo '<pre>';
    print_r($array_word);
    echo '</pre>';
    recurRead( $array_word[0] , 0, count($array_word) );
}

fclose($file);


?>