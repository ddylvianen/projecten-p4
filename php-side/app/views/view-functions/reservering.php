<?php
class reserveringfunctions 
{
    private $sporten = ['zwemmen', 'fitness', 'groepslessen', 'squash', 'tennis', 'padel', 'kinderen', 'cardiospinning', 'kracht' ]; 
    
    public function makelesson($data){


        return
        "<div id='{$data->LesId}' class='les-card'>
            <img src='{$this->checksport($data->lesnaam)}' alt=''>
            <div class='card-text'>
                <h3>{$data->lesnaam}</h3>
                <div class='text'>
                    <p>{$data->Tijd}</p>
                    <p>Aantal plekken over: {$data->LesId}</p>
                </div>
            </div>
            <!-- met js laten saven -->
            <a class='btn'>Uitschrijven</a>
        </div>";
    }

    public function makeweek($week, $weekNumber, $redirect){
        $weken = [
            'old' => $weekNumber - 1,
            'new' => $weekNumber + 1
        ];
        $current = date('W');
        echo
        "<div class='week'>
            <!-- de weken komen hierin -->
            <!-- scrolable maken... bij liks/rechts info opnieuw vragen? of api?-->

            <div class='week-nav'>
                <a href='/reservering?week={$weken["old"]}'><i class='fa-solid fa-arrow-left'></i></a>
                <h1>{$week}</h1>
                <a href='/reservering?week={$weken["new"]}'><i class='fa-solid fa-arrow-right'></i></a>
            </div>
            <a class='current-week' href='/{$redirect}?week={$current}'>deze week</a>
        </div>";
    }

    public function makeday($data, $dagnaam){
        $lessons = '';
        foreach($data as $lesson){
            // check if lesson is in data and return the nam
            $lessons .= $this->makelesson($lesson);
        }
        echo "<div class='dag'>
            <h2>$dagnaam</h2>
            <div class='lessen'>
                <!-- de lessen komen hierin -->
                $lessons
                <span></span>
            </div>
        </div>";
    }

    private function checksport($naam){
        //check if sport is in array or contains sport name
        $waarde = in_array($naam, $this->sporten) ? $naam : $this->sporten[array_rand($this->sporten)];
        return ('../public/img/' . $waarde . '.png');
    }


    
};
