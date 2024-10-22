#include <stdio.h>
#include <stdlib.h>
#include <time.h>

int lin, col, minas;

void criaJogo();
void colocaMinas();
void calculaNumeros();
void mostraJogo(char b[lin][col]);
void revelarVazios(int linha, int coluna);
void jogar();

int main() {
    printf("Insira o número de linhas: ");
    scanf("%d", &lin);
    printf("Insira o número de colunas: ");
    scanf("%d", &col);
    printf("Com quantas minas quer jogar? ");
    scanf("%d", &minas);

    srand(time(0)); 
    criaJogo(); 
    colocaMinas(); 
    calculaNumeros(); 
    jogar(); // Inicia o jogo
    
    return 0;
}

char jogoVis[100][100]; 
char campoMin[100][100]; 

void criaJogo() {
    for (int i = 0; i < lin; i++) {
        for (int j = 0; j < col; j++) {
            jogoVis[i][j] = '-'; 
            campoMin[i][j] = '0'; 
        }
    }
}

void colocaMinas() {
    int cont = 0;
    while (cont < minas) {
        int i = rand() % lin;
        int j = rand() % col;
        if (campoMin[i][j] != '*') {
            campoMin[i][j] = '*'; 
            cont++;
        }
    }
}

void calculaNumeros() {
    for (int i = 0; i < lin; i++) {
        for (int j = 0; j < col; j++) {
            if (campoMin[i][j] == '*') continue;
            int cont = 0;
            for (int x = i - 1; x <= i + 1; x++) {
                for (int y = j - 1; y <= j + 1; y++) {
                    if (x >= 0 && x < lin && y >= 0 && y < col && campoMin[x][y] == '*') {
                        cont++;
                    }
                }
            }
            campoMin[i][j] = '0' + cont;
        }
    }
}

void mostraJogo(char b[100][100]) {
    for (int i = 0; i < lin; i++) {
        for (int j = 0; j < col; j++) {
            printf("%c ", b[i][j]);
        }
        printf("\n");
    }
}

void revelarVazios(int linha, int coluna) {
    if (linha < 0 || linha >= lin || coluna < 0 || coluna >= col || jogoVis[linha][coluna] != '-')
        return;

    jogoVis[linha][coluna] = campoMin[linha][coluna];

    if (campoMin[linha][coluna] == '0') {
        for (int i = linha - 1; i <= linha + 1; i++) {
            for (int j = coluna - 1; j <= coluna + 1; j++) {
                if (i >= 0 && i < lin && j >= 0 && j < col) {
                    revelarVazios(i, j);
                }
            }
        }
    }
}

void jogar() {
    int linJogo, colJogo;
    while (1) {
        mostraJogo(jogoVis); 
        printf("Digite a linha e coluna (ex: 1 1): ");
        scanf("%d %d", &linJogo, &colJogo);
        
        if (campoMin[linJogo][colJogo] == '*') {
            printf("BOOM! Você perdeu!\n");
            mostraJogo(campoMin);
            break;
        } else {
            revelarVazios(linJogo, colJogo);
        }
        
        // Verificar se o jogador venceu
        // Implementar lógica de vitória
    }
}
