<?php

namespace App\Http\Controllers\V3;

use App\Http\HttpHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jikan\Request\Anime\AnimeCharactersAndStaffRequest;
use Jikan\Request\Anime\AnimeEpisodesRequest;
use Jikan\Request\Anime\AnimeForumRequest;
use Jikan\Request\Anime\AnimeMoreInfoRequest;
use Jikan\Request\Anime\AnimeNewsRequest;
use Jikan\Request\Anime\AnimePicturesRequest;
use Jikan\Request\Anime\AnimeRecentlyUpdatedByUsersRequest;
use Jikan\Request\Anime\AnimeRecommendationsRequest;
use Jikan\Request\Anime\AnimeRequest;
use Jikan\Request\Anime\AnimeReviewsRequest;
use Jikan\Request\Anime\AnimeStatsRequest;
use Jikan\Request\Anime\AnimeVideosRequest;

class AnimeController extends Controller
{
    public function main(int $id)
    {
        $anime = $this->jikan->getAnime(new AnimeRequest($id));
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function characters_staff(int $id)
    {
        $anime = $this->jikan->getAnimeCharactersAndStaff(new AnimeCharactersAndStaffRequest($id));
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function episodes(int $id, int $page = 1)
    {
        $anime = $this->jikan->getAnimeEpisodes(new AnimeEpisodesRequest($id, $page));
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function news(int $id)
    {
        $anime = ['articles' => $this->jikan->getNewsList(new AnimeNewsRequest($id))];
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function forum(int $id, ?string $topic = null)
    {
        if ($topic === 'episodes') {
            $topic = 'episode';
        }

        $anime = ['topics' => $this->jikan->getAnimeForum(new AnimeForumRequest($id, $topic))];
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function videos(int $id)
    {
        $anime = $this->jikan->getAnimeVideos(new AnimeVideosRequest($id));
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function pictures(int $id)
    {
        $anime = ['pictures' => $this->jikan->getAnimePictures(new AnimePicturesRequest($id))];
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function stats(int $id)
    {
        $anime = $this->jikan->getAnimeStats(new AnimeStatsRequest($id));
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function moreInfo(int $id)
    {
        $anime = ['moreinfo' => $this->jikan->getAnimeMoreInfo(new AnimeMoreInfoRequest($id))];
        return response(json_encode($anime));
    }

    public function recommendations(int $id)
    {
        $anime = ['recommendations' => $this->jikan->getAnimeRecommendations(new AnimeRecommendationsRequest($id))];
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function userupdates(int $id, int $page = 1)
    {
        $anime = ['users' => $this->jikan->getAnimeRecentlyUpdatedByUsers(new AnimeRecentlyUpdatedByUsersRequest($id, $page))];
        return response($this->serializer->serialize($anime, 'json'));
    }

    public function reviews(int $id, int $page = 1)
    {
        $anime = ['reviews' => $this->jikan->getAnimeReviews(new AnimeReviewsRequest($id, $page))];
        return response($this->serializer->serialize($anime, 'json'));
    }
}
