La consulta de {{ $horarioConsulta->materia->name }} del día
{{ date('d/m/Y', strtotime($horarioConsulta->date_hour)) }} a las {{ date('H:i', strtotime($horarioConsulta->date_hour)) }}
ha salido cancelada por el profesor {{ $horarioConsulta->profesor->name }}.