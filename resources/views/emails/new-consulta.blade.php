Un alumno se ha inscripto a su consulta del día {{ date('d/m/Y', strtotime($consulta->horarioConsulta->date_hour)) }}
a las {{ date('H:i', strtotime($consulta->horarioConsulta->date_hour)) }}