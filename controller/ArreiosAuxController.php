<?php

class ArreiosAuxController {
    
    public static function getTipos() {
        return $tipos = ['1' => 'Usuário', '2' => 'Gerente', 
            '3' => 'Bibliotecário', '4' => 'Atendente'];
    }
    
    public static function getTipoExemplar() {
        return $tipos = ['1' => 'Circular', '2' => 'Não Circular'];
    }


    public static function getEstados() {
        return $estados = ['AC'=>'Acre', 'AL'=>'Alagoas', 'AP'=>'Amapá', 'AM'=>'Amazonas',
                        'BA'=>'Bahia', 'CE'=>'Ceará', 'DF'=>'Distrito Federal', 'ES'=>'Espírito Santo',
                        'GO'=>'Goiás', 'MA'=>'Maranhão', 'MT'=>'Mato Grosso', 'MS'=>'Mato Grosso do Sul',
                        'MG'=>'Minas Gerais','PA'=>'Pará', 'PB'=>'Paraíba', 'PR'=>'Paraná',
                        'PE'=>'Pernambuco', 'PI'=>'Piauí', 'RJ'=>'Rio de Janeiro', 'RN'=>'Rio Grande do Norte',
                        'RS'=>'Rio Grande do Sul', 'RO'=>'Rondônia', 'RR'=>'Roraima', 'SC'=>'Santa Catarina',
                        'SP'=>'São Paulo', 'SE'=>'Sergipe', 'TO'=>'Tocantins'];
    }

}
