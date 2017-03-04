<?php
include("includes/funcoes.php");
$codigo = $_GET["cd"];
constroi_inicio_pagina();
constroi_pagina_anunciante($codigo, 3);
constroi_fim_pagina();
?>