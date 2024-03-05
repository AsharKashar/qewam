<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Vimeo\Vimeo;
use Alaouy\Youtube\Facades\Youtube;

class Lesson extends Model
{
    public function road_map()
    {
        return $this->belongsTo(RoadMap::class, 'road_map_id');

    }

    public function lesson_faqs()
    {
        return $this->hasMany(LessonFaq::class, 'lesson_id');
    }

    public function lesson_videos()
    {
        return $this->hasMany(LessonVideo::class, 'lesson_id');
    }

    public function lesson_quizes()
    {
        return $this->hasMany(LessonQuiz::class, 'lesson_id');
    }
    //
    public static function getDetailsfromVimeoURL($url)
    {
        $regs = array();

        $id = '';

        if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
            $id = $regs[3];
        }

        $client = new Vimeo(config('services.vimeo.client_id'), config('services.vimeo.client_secret'), config('services.vimeo.access_token'));

        $response = $client->request('/videos/'.$id, array(), 'GET');

        // return $response['body']['duration'];
        return $response['body'];
    }

    public static function getDetailsfromYoutubeURL($url)
    {
        $videoId = Youtube::parseVidFromURL($url);
        $video = Youtube::getVideoInfo([$videoId]);
        return $video;
    }
}
