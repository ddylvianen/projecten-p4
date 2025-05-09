<?php

class Lessen
{

    private function makeweek($week, $weekNumber)
    {
        $weken = [
            'old' => $weekNumber - 1,
            'new' => $weekNumber + 1
        ];
        $current = date('W');
        return
            "<div class='week'>
            <!-- de weken komen hierin -->
            <!-- scrolable maken... bij liks/rechts info opnieuw vragen? of api?-->

            <div class='week-nav'>
                <a href='/overzicht?week={$weken["old"]}'><i class='fa-solid fa-arrow-left'></i></a>
                <h1>{$week}</h1>
                <a href='/overzicht?week={$weken["new"]}'><i class='fa-solid fa-arrow-right'></i></a>
            </div>
            <a class='current-week' href='/overzicht?week={$current}'>deze week</a>
        </div>";
    }

    private function maketable($data)
    {   

        $top= "<table class='table'>	
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>MinAantalPersonen</th>
                        <th>MaxAantalPersonen</th>
                        <th>Beschikbaarheid</th>
                        <th>Opmerking</th>
                        <th id='add-lessen'><a href='/overzichtadd'><i class='fa-solid fa-plus'></a></i></th>
                    </tr>
                    </thead>";
        $middle = "";

        foreach ($data as $lesson) {
            $middle .= $this->makelesson($lesson);
        }
        

        return $top . $middle . '</table>';
    }

    // private function makelesson($lesson)
    // {
    //     //<th scope='row'>{$lesson->Id}</th>
    //     return
    //         "<tr>
    //         <td>{$lesson->Naam}</td>
    //         <td>{$lesson->Datum}</td>
    //         <td>{$lesson->Tijd}</td>
    //         <td>{$lesson->MinAantalPersonen}</td>
    //         <td>{$lesson->MaxAantalPersonen}</td>
    //         <td>{$lesson->Beschikbaarheid}</td>
    //         <td>{$lesson->Opmerking}</td>
    //         <td>
    //             <a href='/updateles?id=$lesson->Id'><i class='fa-solid fa-pen-to-square'></i></a>
    //             <a id=$lesson->Id  class=delete><i class='fa-solid fa-trash'></i></a>
    //         </td>
    //         </tr>";
    // }

    private function makelesson($lesson)
    {
        $css = ($lesson->IsActief) ? '' : 'text-decoration: line-through;';
        $rowStyle = !empty($css) ? "style='{$css}'" : '';
        $buttons = ($lesson->IsActief) ? 
            "<a href='/updateles?id=$lesson->Id'><i class='fa-solid fa-pen-to-square'></i></a>
            <a id=$lesson->Id class=delete><i class='fa-solid fa-trash'></i></a>" 
            : '';
        return
            "<tr {$rowStyle}>
            <td>{$lesson->Naam}</td>
            <td>{$lesson->Datum}</td>
            <td>{$lesson->Tijd}</td>
            <td>{$lesson->MinAantalPersonen}</td>
            <td>{$lesson->MaxAantalPersonen}</td>
            <td>{$lesson->Beschikbaarheid}</td>
            <td>{$lesson->Opmerking}</td>
            <td>
            {$buttons}
            </td>
            </tr>";
    }

    public function page($data)
    {
        $view = '';
        $template = new Lessen();
        $view .= $template->makeweek($data['week'], $data['weekNumber'], 'overzicht');
        $view .=  $template->maketable($data['lessen']);
        // $template->makeday($data['lessen']);

        echo $view;
    }
}