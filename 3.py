pola_x = [[1, 2, 3, 0], [2, 3, 3, 0]]
for i in range(1, -1, -1):
    pola_x.append(pola_x[i][len(pola_x[i])-2::-1] + [0])
pola_y = [4, 5, 4]

a = 1
for i in range (len(pola_x)):
    for j in range (len(pola_x[0])):
        print(a, " ", end="")
        a += pola_x[i][j]
    if i < 3:
        a -= pola_y[i]
    print()
