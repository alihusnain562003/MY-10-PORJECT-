<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Quran extends Controller
{
    // Fetch metadata for all surahs
    public function getcontents()
    {
        $response = Http::get("https://api.alquran.cloud/v1/meta");
        $surahData = $response["data"]["surahs"]["references"];

        return view("surah", ["alldata" => $surahData]);
    }

    // Fetch details for a specific surah including ayahs and recitations
    public function getcontentsDetails(Request $request, $snum)
    {
        // Fetch the surah with audio recitation from Sudais
        $responseArabic = Http::get("https://api.alquran.cloud/v1/surah/$snum/ar.abdurrahmaansudais");
        $responseTranslation = Http::get("https://api.alquran.cloud/v1/surah/$snum/en.asad");

        // Get ayahs and their recitation audio
        $ayahsArabic = $responseArabic["data"]["ayahs"];
        $ayahsTranslation = $responseTranslation["data"]["ayahs"];

        return view("read", [
            "dataArabic" => $ayahsArabic,
            "dataTranslation" => $ayahsTranslation
        ]);
    }
}
