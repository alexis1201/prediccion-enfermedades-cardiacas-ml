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
