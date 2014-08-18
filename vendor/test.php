<?php

//@PrimaryKeyJoinColumn
//
//chaves primárias de 2 entidades são iguais 
// -----
//@OneToOne com MappedBy
//
//public class CreditCard { 
//private Pessoa pessoa; 
//@OneToOne(mappedBy=“creditCard”) 
//public Pessoa getPessoa(){ 
//} 
//}
//
//
//public class Pessoa {
//private CreditCard CREDITCARD; 
//@OneToOne(cascade={CascadeType.ALL})
//@JoinColumn(name=“CREDIT_CARD_ID”) 
//public CreditCard getCreditCard(){ } 
//}
//-------
//
//@Entity @Table(name=“PersonHierarchy”) @Inheritance(strategy=InheritanceType.SINGLE_TABLE) @DiscriminatorColumn(name=“IDENTIFICADOR”, discriminatorType=DiscriminatorType.STRING) @DiscriminatorValue(“PESSOA”) 
//public class Pessoa{ private int id; 
//    private String nome; private int idade;
//}
//
//
//
//@Entity 
//@DiscriminatorValue(“PROFESSOR”) 
//public class Professor extends Pessoa{ 
//private int quantidadeTurmas; 
//}
// 
//@Entity 
//@DiscriminatorValue(“ALUNO”) 
//public class Aluno extends Pessoa{ 
//private String matricula;
//}
//Table_per_class
//@Entity @Inheritance(strategy=InheritanceType.TABLE_PER_CLASS) public class Pessoa{ }
//@Entity public class Professor extends Pessoa{} @Entity public class Aluno extends Pessoa{}
//
//joined
//@Entity @Inheritance(strategy=InheritanceType.JOINED) public class Pessoa{ } 
//@Entity public class Professor extends Pessoa{} @Entity public class Aluno extends Pessoa{}
