<?php
function getSujetLigne($nomSujet, $dateSujet, $nomAuteurSujet, $reponses, $photoReponse=null, $dateReponse=null, $nomResponse=null)
{
    if(!$photoReponse || !$dateReponse || !$nomResponse || !$dateReponse){
        $last = 'Il n\'y a pas de réponse';
    }else{
        $last = getLastReponse($photoReponse, $dateReponse, $nomResponse);
    }
    $ret = '
    <div class="card-body py-3">
        <div class="row no-gutters align-items-center">
            <div class="col"> <a href="/AJAX/php/posts.php" class="text-big" data-abc="true">'.$nomSujet.'</a>
                <div class="text-muted small mt-1">Commencé il y a '.$dateSujet.' &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">'.$nomAuteurSujet.'</a></div>
            </div>
            <div class="d-none d-md-block col-4">
                <div class="row no-gutters align-items-center">
                    <div class="col-4">'.$reponses.'</div>
                    <div class="media col-8 align-items-center">
                        '.$last.'
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
    return $ret;
}

function getLastReponse($photoReponse, $dateReponse, $nomResponse){
    return '
    <img src="'.$photoReponse.'" alt="" class="d-block ui-w-30 rounded-circle" height="64" width="64">
    <div class="media-body flex-truncate ml-2">
        <div class="line-height-1 text-truncate">Il y a '.$dateReponse.'</div> <a href="javascript:void(0)" class="text-muted small text-truncate" data-abc="true">par '.$nomResponse.'</a>
    </div>
    ';
}

function getForumLigne($nomForum, $idForum, $descriptionForum, $nbSujets, $nbPost, $nomLastSujet=null, $idLastSujet=null, $nomAuteur=null, $dateModif=null){
    if(!$nomLastSujet || !$idLastSujet || !$nomAuteur || !$dateModif){
        $last = 'Il n\'y a pas de post';
    }else{
        $last = getLastPostInfosCase($nomLastSujet, $idLastSujet, $nomAuteur, $dateModif);
    }
    $ret = '
    <tr>
        <td>
            <h3 class="h5 mb-0"><a href="/AJAX/php/sujets.php?forum='.$idForum.'">'.$nomForum.'</a></h3>
            <p class="mb-0">'.$descriptionForum.'</p>
        </td>
        <td>
            <div>'.$nbSujets.'</div>
        </td>
        <td>'.$nbPost.'</td>
        <td>
            '.$last.'
        </td>
    </tr>
    ';
    return $ret;
}

function getLastPostInfosCase($nomLastSujet, $idLastSujet, $nomAuteur, $dateModif){
    return '
    <h4 class="h6 mb-0"><a href="/AJAX/php/posts?sujet='.$idLastSujet.'"> '.$nomLastSujet.'</a></h4>
    <div> par <a href="#">'.$nomAuteur.'</a></div>
    <div> Il y a '.$dateModif.'</div>
    ';
}