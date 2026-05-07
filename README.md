# 🫀 Predicción de Enfermedades Cardíacas — Machine Learning

> Proyecto Final de Aprendizaje Automático · ISTII Generación 2022

[![Python](https://img.shields.io/badge/Python-3.10+-blue?logo=python)](https://python.org)
[![scikit-learn](https://img.shields.io/badge/scikit--learn-1.x-orange?logo=scikit-learn)](https://scikit-learn.org)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4-red?logo=codeigniter)](https://codeigniter.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Aplicación de Machine Learning para apoyar el diagnóstico de enfermedades cardíacas a partir de variables clínicas. Desarrollado como proyecto final del curso de Aprendizaje Automático.

🌐 **Demo en vivo:** [https://proyecto-final-ap.wuaze.com/public/](https://proyecto-final-ap.wuaze.com/public/)

---

## 📌 Descripción

Se entrenaron y compararon tres algoritmos de clasificación sobre el [Heart Disease Dataset (Kaggle)](https://www.kaggle.com/datasets/johnsmith88/heart-disease-dataset) para predecir la presencia de enfermedad cardíaca en pacientes. El mejor modelo (KNN k=11) fue integrado en una aplicación web con CodeIgniter 4.

---
## 🗂️ Estructura del proyecto
heart-disease-ml-predictor/
├── notebook/
│   └── proyecto_ML_heart_disease_V5.ipynb   # Notebook principal (Google Colab)
├── modelo/
│   └── modelo_knn_cardio.pkl                # Modelo + scaler exportados
├── app/                                     # Aplicación CodeIgniter 4
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── assets/
│   └── img/                                 # Capturas de la app y gráficas
├── reporte/
│   └── Reporte_Avance_S1_S2_S3_S4_S5.pdf
└── README.md

---

## 📊 Dataset

| Campo | Detalle |
|---|---|
| Nombre | Heart Disease Dataset |
| Fuente | [Kaggle](https://www.kaggle.com/datasets/johnsmith88/heart-disease-dataset) |
| Instancias | 1,025 originales → 302 tras limpieza |
| Atributos | 14 (13 predictores + 1 objetivo) |
| Origen | Cleveland Clinic, Hungarian Institute, Long Beach VA, Univ. Zúrich |

---

## ⚙️ Pipeline de Machine Learning
Dataset → Limpieza (eliminación de 723 duplicados)
→ EDA (histogramas, correlaciones, boxplots)
→ Normalización Min-Max (5 variables continuas)
→ Selección de características (ANOVA + Random Forest → 9 features)
→ Entrenamiento con CV-10 estratificada
→ Evaluación y comparación de modelos
→ Exportación pickle → Deploy en CodeIgniter 4

### Características seleccionadas (9)

`cp` · `thalach` · `oldpeak` · `ca` · `thal` · `exang` · `age` · `slope` · `trestbps`

---

## 🤖 Resultados de modelos

| Modelo | Accuracy | Precision | Recall | F1-Score |
|---|---|---|---|---|
| Baseline (ZeroR) | 0.543 | 0.543 | 1.000 | 0.704 |
| Árbol de Decisión (depth=3) | 0.789 | 0.773 | 0.868 | 0.815 |
| **KNN (k=11)** ⭐ | **0.834** | **0.813** | **0.916** | **0.858** |
| SVM (rbf, C=10) | 0.834 | 0.819 | 0.904 | 0.856 |

> Validación cruzada estratificada de 10 dobleces (StratifiedKFold, random_state=42)

**★ Mejor modelo: KNN k=11** — Mayor F1-Score (0.858) y Recall (0.916), minimizando falsos negativos en contexto clínico.

---

## 🌐 Aplicación Web (CodeIgniter 4)

La aplicación permite ingresar datos clínicos de un paciente y obtener una predicción en tiempo real:

- Sliders para variables continuas (edad, presión arterial, FC máxima, depresión ST)
- Dropdowns para variables categóricas (tipo de dolor, talasemia, vasos, angina, pendiente ST)
- Resultado con diagnóstico estimado y probabilidad de confianza
- 3 casos de prueba predefinidos (bajo riesgo, alto riesgo, caso límite)

---

## 🚀 Instalación local (Notebook)

```bash
# Clonar el repositorio
git clone https://github.com/TU_USUARIO/heart-disease-ml-predictor.git
cd heart-disease-ml-predictor

# Instalar dependencias
pip install pandas numpy scikit-learn matplotlib seaborn ipywidgets

# Abrir el notebook
jupyter notebook notebook/proyecto_ML_heart_disease_V5.ipynb
```

---

## 👥 Autores

Jesús Martínez Romero | 202243496 |
Alexis Miguel Ramos Flores | 202249357 |

ISTII — Generación 2022

---

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Ver [LICENSE](LICENSE) para más detalles.

