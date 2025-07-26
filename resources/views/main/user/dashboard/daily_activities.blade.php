@extends('main.layouts.main')
@section('content')
    <section class="accrodion-one dlyremind">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    @include('main.layouts.dashboard-menu')
                </div>
                <div class="col-lg-9">
                    <h4 class="pb-1">Daily Activities</h4>
                    <ul class="dlyactivity">
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-1" id="actvity-1"><label for="actvity-1">AL 5x Fard Salah + Sunnah SalahAAB200</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-2" id="actvity-2"><label for="actvity-2">Sadaqah + One Secret Good Deed</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-3" id="actvity-3"><label for="actvity-3">100x Astagfaar + 100x Durood</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-4" id="actvity-4"><label for="actvity-4">Tahajjud - Min 4 Days / Week</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-5" id="actvity-5"><label for="actvity-5">Qur'an Recitation</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-6" id="actvity-6"><label for="actvity-6">Memorising 2 Ayahs Of Quran Daily</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-7" id="actvity-7"><label for="actvity-7">Following Sunnah of Waking Up, Sleeping, Eating etc</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-8" id="actvity-8"><label for="actvity-8">Listening & Sharing 3 Bayaan + Hadith (Short Or Long) Daily to Status Or Contact As Sadaqa-e
                                    Jariya</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-9" id="actvity-9"><label for="actvity-9">Not Watching Movies, Listening Song, Backbiting,
                                    Abusing, Fighting etc</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-10" id="actvity-10"><label for="actvity-10">Attending Islamic Sessions Live / Recorded</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-11" id="actvity-11"><label for="actvity-11">Feeding 1 Needy or Poor Atleast Once A Week</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-12" id="actvity-12"><label for="actvity-12">Helping Family In Household Chores</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-13" id="actvity-13"><label for="actvity-13">Staying In Wudu & Purity Entire Day As Much Possible & If Broke, Make Again</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-14" id="actvity-14"><label for="actvity-14">Fasting Twice A Week - Mon & thur</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-15" id="actvity-15"><label for="actvity-15">Eating Kalunji + Honey + Using Miswaak</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-16" id="actvity-16"><label for="actvity-16">Exercising For 5-10 Mins Daily</label></div></li>
                        <li><div class="activitycheck"><input type="checkbox" name="actvity-17" id="actvity-17"><label for="actvity-17">Talk to Your Relatives Atleast Once A Week</label></div></li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
