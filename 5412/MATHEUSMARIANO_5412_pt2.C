#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
#include <ctype.h>

int validaIP(const char *ipDigitado);
void inicializarJogo(char tabuleiro[10][10], int *tamCobra);
void posicionaFruta(char tabuleiro[10][10]);
void imprimeTabuleiro(char tabuleiro[10][10]);
void jogar(char tabuleiro[10][10], int tamCobra);

int main()
{
    srand(time(0));
    
    int opc;
    do {
        printf("Digite 1 para o Programa 1 \n");
        printf("Digite 2 para o Programa 2 \n");
        printf("Digite 3 para o Programa 3 \n");
        printf("Digite 4 para o Programa 4 \n");
        printf("Digite 5 para o Programa 5 \n");
        printf("Digite 0 para o sair \n");
        scanf("%d", &opc);
        getchar();
        
        if(opc == 1){
            
            printf("Bem vindo ao programa: verificar Saldo \n");
            float receitas, despesas, saldo;
            do{
                printf("Digite o valor total das receitas: ");
                scanf("%f", &receitas);
                if(receitas < 0){
                    printf("Não pode inserir um número negativo!\n");
                }
            } while (receitas<0);

            do{
                printf("Digite o valor total das despesas: ");
                scanf("%f", &despesas);
                if(despesas < 0){
                    printf("Não pode inserir um número negativo!\n");
                }
            } while (despesas<0);

            saldo = receitas - despesas;

            printf("O saldo é: %.2f", saldo);
            
        } else if (opc == 2){
            
            printf("Bem vindo ao programa: Analisar despesas de viagem \n");
            int numDespesas; 
            
            do{
                printf("Digite o número de despesas: ");
                scanf("%d", &numDespesas);
                if (numDespesas<=0){
                    printf("Erro: o número de despesas não pode ser menor ou igual a zero! \n");
                }
            } while (numDespesas<=0);
            
            float previsto[numDespesas], gasto[numDespesas], saldo[numDespesas];

            for (int i=0; i<numDespesas; i++){
                do{
                    printf("Digite o valor previsto para a %da despesa: ", i + 1);
                    scanf("%f", &previsto[i]);
                    if (previsto[i]<0){
                        printf("O valor nao pode ser negativo! \n");
                    }
                } while (previsto[i]<0);

                do{
                    printf("Digite o valor real gasto para a %da despesa: ", i + 1);
                    scanf("%f", &gasto[i]);
                    if (gasto[i]<0){
                        printf("O valor nao pode ser negativo! \n");
                    }
                } while (gasto[i]<0);
                
                saldo[i] = previsto[i] - gasto[i];
            }

            for (int i = 0; i < numDespesas; i++) {
                if (saldo[i] < 0) {
                    printf("Cuidado! a %da despesa está %.2f acima do orçamento \n", i + 1, saldo[i]*(-1));
                } else if(saldo[i] == 0) {
                    printf("A %da despesa está dentro do orçamento, o saldo é %.2f \n", i + 1, saldo[i]);
                } else {
                    printf("BRAVO! a %da despesa ficou %.2f abaixo do orçamento \n", i + 1, saldo[i]);
                }
            }
            
        } else if (opc == 3){
            
            printf("Bem vindo ao programa para verificar endereço de IP \n");

            char ipDigitado[16];
            do {
                printf("Digite o IP que deseja validar: ");
                scanf("%s", ipDigitado);
                if (validaIP(ipDigitado) !=1){
                    printf("Erro! Digite um endereço de IP válido \n");
                }
            } while (validaIP(ipDigitado) != 1);

            //Criar uma copia do IP para preservar o original
            char temp2[16];
            strncpy(temp2,ipDigitado,16);
            temp2[15] = '\0';

            char *token = strtok(temp2, ".");
            int primOcteto = atoi(token);

             if (primOcteto >= 0 && primOcteto <= 127) {
                printf("A classe do IP é 'A'");
            } else if (primOcteto >= 128 && primOcteto <= 191) {
                printf("A classe do IP é 'B'");
            } else if (primOcteto >= 192 && primOcteto <= 223) {
                printf("A classe do IP é 'C'");
            } else if (primOcteto >= 224 && primOcteto <= 239) {
                printf("A classe do IP é 'D'");
            } else {
                printf("A classe do IP é 'E'");
            }
            
        } else if (opc == 4){
        
            printf("Bem vindo ao programa: Conversão Cambial \n");
           // Códigos das moedas
            const char *codMoeda[] = {
                "USD", "JPY", "BGN", "CZK", "DKK", "GBP", "HUF", "PLN", "RON", "SEK", 
                "CHF", "ISK", "NOK", "TRY", "AUD", "BRL", "CAD", "CNY", "HKD", "IDR", 
                "ILS", "INR", "KRW", "MXN", "MYR", "NZD", "PHP", "SGD", "THB", "ZAR"
            };

            // Nomes das moedas
            const char *nomeMoeda[] = {
                "US dollar", "Japanese yen", "Bulgarian lev", "Czech koruna", "Danish krone", 
                "Pound sterling", "Hungarian forint", "Polish zloty", "Romanian leu", 
                "Swedish krona", "Swiss franc", "Icelandic krona", "Norwegian krone", 
                "Turkish lira", "Australian dollar", "Brazilian real", "Canadian dollar", 
                "Chinese yuan renminbi", "Hong Kong dollar", "Indonesian rupiah", 
                "Israeli shekel", "Indian rupee", "South Korean won", "Mexican peso", 
                "Malaysian ringgit", "New Zealand dollar", "Philippine peso", 
                "Singapore dollar", "Thai baht", "South African rand"
            };

            // Taxas de câmbio
            const float taxa[] = {
                1.0774, 165.66, 1.9558, 25.372, 7.4588, 0.83020, 405.23, 4.3480, 4.9749, 
                11.5170, 0.9369, 148.70, 11.8415, 36.9491, 1.6423, 6.1613, 1.4981, 
                7.6895, 8.3716, 16993.40, 4.0298, 90.5700, 1496.40, 21.5719, 4.7172, 
                1.8076, 62.857, 1.4287, 36.400, 19.1063
            };

            float valor, convertido;

            printf("Digite o valor em Euros que você deseja converter: ");
            scanf("%f", &valor);

            char inptMoeda[4];
            printf("Digite o código da moeda para qual deseja converter \n Sabendo que os códigos disponíveis são:  ");
            for (int i = 0; i < 30; i++){
                printf("%s - %s \n", codMoeda[i], nomeMoeda[i]);
            }
            int j, valida = 0;
            do{
                printf("Digite o código: ");
                scanf("%3s", inptMoeda);
                for (j = 0; j < 30; j++){
                    if (strcmp(inptMoeda, codMoeda[j]) == 0){
                        valida = 1;
                        break;
                    } 
                }
                if (valida == 0){
                    printf("Digite um código válido!\n");
                }
            } while (valida == 0);
            
            convertido = valor * taxa[j];
            
            printf("O valor de EUR %.2f convertido em %s é de: %.2f", valor, nomeMoeda[j], convertido);
            
        } else if (opc == 5){

            printf("Bem vindo ao programa: jogo da cobra \n");

            char tabuleiro[10][10];
            int tamCobra = 1;

            criarTabuleiro(tabuleiro, &tamCobra);

            jogar(tabuleiro, tamCobra);
                        
        } else {
            
            printf("Erro: opção inválida! \n");
            
        }
        
        printf("\n REBOOT \n");
        
    } while (opc != 0);
    
    printf("ADEUS! \n");
    
    return 0;
}

int validaIP(const char *ipDigitado){
    //Criar uma copia do IP para preservar o original
    char temp[16];
    strncpy(temp,ipDigitado,16);
    temp[15] = '\0';

    //Explodir o IP com token . para validar se foi ditado corretamente
    char *token = strtok(temp, ".");
    int cont = 0;

    while (token != NULL) {
        // Confirmar que foram digitados numeros 
        for (int i = 0; i < strlen(token); i++) {
            if (!isdigit(token[i])) {
                return 0;
            }
        }

        int num = atoi(token);  // Converter char para número

        if (cont == 0 && num == 0 && strcmp(token, "0") != 0){
            return 0; // confirmar que o primeiro octeto nao pode ser 0 
        }

        // Verifica se está entre 0 e 255
        if (num < 0 || num > 255) {
            return 0;  // IP inválido
        }

        cont++;  // Contador de octetos 
        token = strtok(NULL, ".");
    }

    // Verificar se são quatro octetos
    return (cont == 4) ? 1 : 0;
    
}

void criarTabuleiro(char tabuleiro, int tamCobra){
    // criar o tabuleiro
    for (int i = 0; i < 10; i++){
        for (int j = 0; j < 10; j++){
            if (i == 0 || i == 9){
                tabuleiro[i][j] = '-'
            } else if (j == 0 || j == 9){
                tabuleiro[i][j] = '|';
            } else {
                tabuleiro[i][j] = ' ';
            }
        }
    }
    //posicionar a cobra
    tabuleiro[4][4] = 'S';
    posicionarFruta(tabuleiro);
}

void posicionarFruta(char tabuleiro[10][10]) {
    //posicionar uma fruta por vez para deixar o jogo mais dinamico 
    int iFruta, jFruta; 
    do {
        iFruta = rand() % 8 + 1;
        jFruta = rand() % 8 + 1; 
    } while (tabuleiro[iFruta][jFruta] == 'S' || tabuleiro[iFruta][jFruta] == 'O');
    tabuleiro[iFruta][jFruta] = '.';
}

void jogar(char tabuleiro, int tamCobra){
    char direcao;
    imprimeTabuleiro(tabuleiro);
    while (verificaDerrota == 0 && tamCobra<6){
        printf("Digite a direção em que deseja ir, sendo: \n A - direita \n D - esquerda \n W - cima \n S - baixo \n");
        do {
            printf("Digite a direção: ");
            scanf("%c", &direcao);
            direcao = toupper(direcao);
            if (direcao != 'A' || direcao != 'S' || direcao != 'D' || direcao != 'W'){
                printf("Digite um caractere válido! \n");
            }
        } while (direcao != 'A' || direcao != 'S' || direcao != 'D' || direcao != 'W');


    }

    moveCobra(tabuleiro, direcao);
    verificaDerrota(tabuleiro);

}


