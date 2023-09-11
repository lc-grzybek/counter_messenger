<?php
const FILENAMEPATH = "message_1.json";

/**
 * Summary of decode
 * @param mixed $participants
 * @param mixed $messages
 * @return void
 */
function decode (&$participants, &$messages)
{
    
    $jsonData = file_get_contents(FILENAMEPATH);
    $data = json_decode($jsonData, true);
        if ($data !== null) 
        {
            $participants = $data['participants'];
            $messages = $data['messages'];   
        } 
    else 
        {
            echo "Error decoding JSON";
        }
}

/**
 * Summary of getParticipants
 * @param mixed $participants
 * @return void
 */
function getParticipants($participants,&$firstParticipant, &$secondParticipant)
{    
    foreach ($participants as $key => $participant) {
        if ($key === 0 && isset($participant['name'])) {
            $firstParticipant = $participant['name'];
        } 
        elseif ($key === 1 && isset($participant['name'])) 
        {
        $secondParticipant = $participant['name'];
        }
        
    }
}

/**
 * Summary of countMessages
 * @param mixed $messages
 * @param mixed $firstParticipant
 * @param mixed $secondParticipant
 * @param mixed $countFirst
 * @param mixed $countSecond
 * @return void
 */
function countMessages($messages, $firstParticipant, $secondParticipant, &$countFirst, &$countSecond)
{
    foreach($messages as $record){
        if (isset($record['sender_name']) && $record['sender_name'] == $firstParticipant)
        {
            $countFirst++;
        }
        elseif (isset($record['sender_name']) && $record['sender_name'] == $secondParticipant)
        {
            $countSecond++;
        }  
    }
}
decode($participants, $messages);
getParticipants($participants, $firstParticipant, $secondParticipant);
countMessages($messages, $firstParticipant, $secondParticipant, $countFirst, $countSecond);
echo $firstParticipant ." ". $countFirst ;
echo PHP_EOL;
echo $secondParticipant ." ". $countSecond ;