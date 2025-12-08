# Hospital Patient Priority Queue System
# Author: Clyde Ivan Lucido
# Data Structures: Priority Queue, Hash Table, Linked List
# Python Version: 3.x

import heapq
import datetime

class Patient:
    def __init__(self, patient_id, name, severity, category, admission_date):
        self.patient_id = patient_id
        self.name = name
        self.severity = severity  # Higher number = more severe
        self.category = category  # ICU, General, Outpatient
        self.admission_date = datetime.datetime.strptime(admission_date, "%Y-%m-%d")
        self.discharged = False

    def __lt__(self, other):
        # Priority queue: higher severity first; tie-breaker: earlier admission
        if self.severity == other.severity:
            return self.admission_date < other.admission_date
        return self.severity > other.severity

    def __str__(self):
        status = "Discharged" if self.discharged else "Pending"
        return f"ID:{self.patient_id} | {self.name} | Severity:{self.severity} | Category:{self.category} | Admission:{self.admission_date.date()} | {status}"


class HospitalQueueSystem:
    def __init__(self):
        self.patient_heap = []      # Priority queue for pending patients
        self.patient_dict = {}      # Hash table for fast lookup by ID
        self.discharged_list = []   # Linked list for discharged patients

    def add_patient(self, patient):
        if patient.patient_id in self.patient_dict:
            print("Patient ID already exists!")
            return
        heapq.heappush(self.patient_heap, patient)
        self.patient_dict[patient.patient_id] = patient
        print(f"Patient '{patient.name}' added successfully.")

    def discharge_patient(self):
        if not self.patient_heap:
            print("No pending patients to discharge!")
            return
        patient = heapq.heappop(self.patient_heap)
        patient.discharged = True
        self.discharged_list.append(patient)
        self.patient_dict.pop(patient.patient_id)
        print(f"Patient '{patient.name}' discharged successfully.")

    def update_patient(self, patient_id, name=None, severity=None, category=None):
        if patient_id not in self.patient_dict:
            print("Patient not found!")
            return
        patient = self.patient_dict[patient_id]
        if name:
            patient.name = name
        if severity:
            patient.severity = severity
        if category:
            patient.category = category
        # Rebuild heap to adjust priority if severity changed
        heapq.heapify(self.patient_heap)
        print(f"Patient '{patient.name}' updated successfully.")

    def view_pending_patients(self):
        if not self.patient_heap:
            print("No pending patients!")
            return
        print("\n--- Pending Patients (Priority Order) ---")
        for patient in sorted(self.patient_heap):
            print(patient)

    def view_discharged_patients(self):
        if not self.discharged_list:
            print("No discharged patients yet!")
            return
        print("\n--- Discharged Patients ---")
        for patient in self.discharged_list:
            print(patient)

    def search_patient(self, patient_id):
        if patient_id in self.patient_dict:
            print("Patient Found:")
            print(self.patient_dict[patient_id])
        else:
            print("Patient not found!")


# Simple Console UI
def main():
    hospital = HospitalQueueSystem()
    patient_counter = 1

    while True:
        print("\nHospital Patient Priority Queue Menu")
        print("1. Add Patient")
        print("2. Discharge Patient (Highest Severity)")
        print("3. Update Patient")
        print("4. View Pending Patients")
        print("5. View Discharged Patients")
        print("6. Search Patient")
        print("0. Exit")

        choice = input("Enter your choice: ")

        if choice == "1":
            name = input("Patient Name: ")
            severity = int(input("Severity (higher number = more critical): "))
            category = input("Category (ICU, General, Outpatient): ")
            admission_date = input("Admission Date (YYYY-MM-DD): ")
            patient = Patient(patient_counter, name, severity, category, admission_date)
            hospital.add_patient(patient)
            patient_counter += 1
        elif choice == "2":
            hospital.discharge_patient()
        elif choice == "3":
            patient_id = int(input("Enter Patient ID to update: "))
            name = input("New Name (press enter to skip): ")
            severity_input = input("New Severity (press enter to skip): ")
            category = input("New Category (press enter to skip): ")
            severity = int(severity_input) if severity_input else None
            hospital.update_patient(patient_id, name if name else None, severity, category if category else None)
        elif choice == "4":
            hospital.view_pending_patients()
        elif choice == "5":
            hospital.view_discharged_patients()
        elif choice == "6":
            patient_id = int(input("Enter Patient ID to search: "))
            hospital.search_patient(patient_id)
        elif choice == "0":
            print("Exiting system. Goodbye!")
            break
        else:
            print("Invalid choice. Please try again.")
            
main()
