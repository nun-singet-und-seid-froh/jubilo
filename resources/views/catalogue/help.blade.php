@extends('layouts.page')

@section('head')
     <script src="{{ asset('js/catalogue-filter.js') }}"></script>
     <script src="{{ asset('js/icon-check.js') }}"></script>
@endsection

@section('page-content')

<div class="title row">
    Hilfe zur Benutzung des Katalogs
</div>

<p>Der Katalog listet alle Stücke auf, die im Projekt herausgegeben sind. Die Stücke sind dabei in alphabetischer Reihenfolge ihrer Titel sortiert.</p>

<h1>Benutzung des Filters</h1>
<p>Der Katalog kann mithilfe mehrerer Kriterien gefiltert werden.</p>
<p>Ist ein Feld - wie in der Starteinstellung - leer, ẃird die Liste der Stücke nicht nach diesem Kriterium eingeschränkt. Will man ein einmal ausgewähltes Kriterium aus dem Filter entfernen, stellt man einfach wieder den leeren Eintrag ein. Die Einträge in den Filtern werden dabei dynamisch erneuert. Ein Beispiel: Gibt es von dem Komponisten Hugo Distler kein Stück mit dem Titel "Es kommt ein Schiff, geladen", so verschwindet der Filtereintrag "Es kommt ein Schiff, geladen" im Filter "Titel", sobald bei Komponist*in "Distler, Hugo" angewählt wurde.</p>

<h1>Erläuterung der Kriterien</h1>
<p>Die Kriterien sind größtenteils selbsterklärend. Besonderer Erklärung bedürfen möglicherweise die folenden Kriterien:</p>
<ul>
    <li><b>Opus</b>: Falls ein Liedsatz Teil eines größeren Werkes ist, dann wird dieses Werk hier als <i>Opus</i> des Liedsatzes bezeichnet.</li>
    <li><b>Cantus</b>: Viele Lieder sind Bearbeitungen einer alten Melodie. Als <i>Cantus</i> eines Stücks wird in dieser Edition die Melodie verstanden, die dem Notensatz ursprünglich zugrundeliegt. Dabei werden auch Variationen ein und derselben Melodie dem gleichen Cantus zugeordnet.<br/>
    </li>etc
    <li><b>Prätext</b>: Die <i>Prätext</i> ist für den Text das, was der Cantus für die Melodie ist: Mitunter nimmt ein Satz eines Liedes den Text in veränderter Form auf. Beispiele dafür können minimale Textveränderungen sein, es kann sich aber auch um ganze Strophen handeln; oder es kann auch ein Text eine Übersetzung einer Prätext sein.</li>
    <li><b>Ensemble</b>: Unter <i>Ensemble</i> verstehen wir die Art des Chores, für den das Stück geschrieben ist, also etwa Gemischter Chor oder Frauenchor, etc.</li>
    <li><b>Besetzung</b>: Unter <i>Besetzung</i> verstehen wir die Stimmen, in denen ein Stück gesetzt ist, also etwa SSATB für ein Stück mit 1. Sopran, 2. Sopran, Alt, Tenor und Bass.</li>
    <li><b>Schwierigkeit</b>: Der <i>Schwierigkeitsgrad</i> eines Stückes ist natürlich immer ein bisschen subjektiv und hängt von den Kenntnissen und Fähigkeiten des Chores ab. Wir teilen die Stücke in folgende 5 Gruppen ein und orientieren uns dabei an den folgenden Kriterien:
        <ul>
            <li><i>sehr leicht</i>: zwei bis drei Stimmen, Homophonie mit einfachen Harmonien</li>
            <li><i>leicht</i>: vier bis fünf Stimmen, homophon</li>
            <li><i>mittelschwer</i>: Bis zu vier Stimmen oder doppelchörig, polyphon</li>
            <li><i>schwer</i>: Polyphonie mit vielen Stimmen</li>
            <li><i>sehr schwer</i>: Polyphoner Satz mit vielen Stimmen und anspruchsvoller Harmonik und Rhythmik</li>
            
        </ul>
    </li>
</ul>    

<a class="hint-link" href="/catalogue">zum Katalog</a>
@endsection
