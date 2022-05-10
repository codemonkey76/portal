<?php

namespace Database\Seeders;

use App\Models\AccountClassification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asset = AccountClassification::create(['name' => 'Asset']);
        $equity = AccountClassification::create(['name' => 'Equity']);
        $expense = AccountClassification::create(['name' => 'Expense']);
        $liability = AccountClassification::create(['name' => 'Liability']);
        $revenue = AccountClassification::create(['name' => 'Revenue']);

        $this->seedBank($asset);
        $this->seedOtherCurrentAsset($asset);
        $this->seedFixedAsset($asset);
        $this->seedOtherAsset($asset);
        $this->seedReceivable($asset);
        $this->seedEquity($equity);
        $this->seedExpense($expense);
        $this->seedOtherExpense($expense);
        $this->seedCogs($expense);
        $this->seedAp($liability);
        $this->seedCc($liability);
        $this->seedLtLiability($liability);
        $this->seedOcLiability($liability);
        $this->seedIncome($revenue);
        $this->seedOIncome($revenue);
    }

    private function seedBank($asset)
    {
        $type = $asset->accountTypes()->create(['name' => 'Bank']);
        $default = $type->accountSubTypes()->create(['name' => 'CashOnHand']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'Checking']);
        $type->accountSubTypes()->create(['name' => 'MoneyMarket']);
        $type->accountSubTypes()->create(['name' => 'RentsHeldInTrust']);
        $type->accountSubTypes()->create(['name' => 'Savings']);
        $type->accountSubTypes()->create(['name' => 'TrustAccounts']);
        $type->accountSubTypes()->create(['name' => 'CashAndCashEquivalents']);
        $type->accountSubTypes()->create(['name' => 'OtherEarMarkedBankAccounts']);
    }

    private function seedOtherCurrentAsset($asset)
    {
        $type = $asset->accountTypes()->create(['name' => 'Other current asset']);
        $type->accountSubTypes()->create(['name' => 'AllowanceForBadDebts']);
        $type->accountSubTypes()->create(['name' => 'DevelopmentCosts']);
        $default = $type->accountSubTypes()->create(['name' => 'EmployeeCashAdvances']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'OtherCurrentAssets']);
        $type->accountSubTypes()->create(['name' => 'Inventory']);
        $type->accountSubTypes()->create(['name' => 'Investment_MortgageRealEstateLoans']);
        $type->accountSubTypes()->create(['name' => 'Investment_Other']);
        $type->accountSubTypes()->create(['name' => 'Investment_TaxExemptSecurities']);
        $type->accountSubTypes()->create(['name' => 'Investment_USGovernmentObligations']);
        $type->accountSubTypes()->create(['name' => 'LoansToOfficers']);
        $type->accountSubTypes()->create(['name' => 'LoansToOthers']);
        $type->accountSubTypes()->create(['name' => 'LoansToStockholders']);
        $type->accountSubTypes()->create(['name' => 'PrepaidExpenses']);
        $type->accountSubTypes()->create(['name' => 'Retainage']);
        $type->accountSubTypes()->create(['name' => 'UndepositedFunds']);
        $type->accountSubTypes()->create(['name' => 'AssetsAvailableForSale']);
        $type->accountSubTypes()->create(['name' => 'BalWithGovtAuthorities']);
        $type->accountSubTypes()->create(['name' => 'CalledUpShareCapitalNotPaid']);
        $type->accountSubTypes()->create(['name' => 'ExpenditureAuthorisationsAndLettersOfCredit']);
        $type->accountSubTypes()->create(['name' => 'GlobalTaxDeferred']);
        $type->accountSubTypes()->create(['name' => 'GlobalTaxRefund']);
        $type->accountSubTypes()->create(['name' => 'InternalTransfers']);
        $type->accountSubTypes()->create(['name' => 'OtherConsumables']);
        $type->accountSubTypes()->create(['name' => 'ProvisionsCurrentAssets']);
        $type->accountSubTypes()->create(['name' => 'ShortTermInvestmentsInRelatedParties']);
        $type->accountSubTypes()->create(['name' => 'ShortTermLoansAndAdvancesToRelatedParties']);
        $type->accountSubTypes()->create(['name' => 'TradeAndOtherReceivables']);
    }

    private function seedFixedAsset($asset)
    {
        $type = $asset->accountTypes()->create(['name' => 'Fixed Asset']);
        $type->accountSubTypes()->create(['name' => 'AccumulatedDepletion']);
        $type->accountSubTypes()->create(['name' => 'AccumulatedDepreciation']);
        $type->accountSubTypes()->create(['name' => 'DepletableAssets']);
        $type->accountSubTypes()->create(['name' => 'FixedAssetComputers']);
        $type->accountSubTypes()->create(['name' => 'FixedAssetCopiers']);
        $type->accountSubTypes()->create(['name' => 'FixedAssetFurniture']);
        $type->accountSubTypes()->create(['name' => 'FixedAssetPhone']);
        $type->accountSubTypes()->create(['name' => 'FixedAssetPhotoVideo']);
        $type->accountSubTypes()->create(['name' => 'FixedAssetSoftware']);
        $type->accountSubTypes()->create(['name' => 'FixedAssetOtherToolsEquipment']);
        $default = $type->accountSubTypes()->create(['name' => 'FurnitureAndFixtures']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'Land']);
        $type->accountSubTypes()->create(['name' => 'LeaseholdImprovements']);
        $type->accountSubTypes()->create(['name' => 'OtherFixedAssets']);
        $type->accountSubTypes()->create(['name' => 'AccumulatedAmortization']);
        $type->accountSubTypes()->create(['name' => 'Buildings']);
        $type->accountSubTypes()->create(['name' => 'IntangibleAssets']);
        $type->accountSubTypes()->create(['name' => 'MachineryAndEquipment']);
        $type->accountSubTypes()->create(['name' => 'Vehicles']);
        $type->accountSubTypes()->create(['name' => 'AssetsInCourseOfConstruction']);
        $type->accountSubTypes()->create(['name' => 'CapitalWip']);
        $type->accountSubTypes()->create(['name' => 'CumulativeDepreciationOnIntangibleAssets']);
        $type->accountSubTypes()->create(['name' => 'IntangibleAssetsUnderDevelopment']);
        $type->accountSubTypes()->create(['name' => 'LandAsset']);
        $type->accountSubTypes()->create(['name' => 'NonCurrentAssets']);
        $type->accountSubTypes()->create(['name' => 'ParticipatingInterests']);
        $type->accountSubTypes()->create(['name' => 'ProvisionsFixedAssets']);
    }

    private function seedOtherAsset($asset)
    {
        $type = $asset->accountTypes()->create(['name' => 'Other Asset']);
        $type->accountSubTypes()->create(['name' => 'LeaseBuyout']);
        $type->accountSubTypes()->create(['name' => 'OtherLongTermAssets']);
        $type->accountSubTypes()->create(['name' => 'SecurityDeposits']);
        $type->accountSubTypes()->create(['name' => 'AccumulatedAmortizationOfOtherAssets']);
        $type->accountSubTypes()->create(['name' => 'Goodwill']);
        $default = $type->accountSubTypes()->create(['name' => 'Licenses']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'OrganizationalCosts']);
        $type->accountSubTypes()->create(['name' => 'AssetsHeldForSale']);
        $type->accountSubTypes()->create(['name' => 'AvailableForSaleFinancialAssets']);
        $type->accountSubTypes()->create(['name' => 'DeferredTax']);
        $type->accountSubTypes()->create(['name' => 'Investments']);
        $type->accountSubTypes()->create(['name' => 'LongTermInvestments']);
        $type->accountSubTypes()->create(['name' => 'LongTermLoansAndAdvancesToRelatedParties']);
        $type->accountSubTypes()->create(['name' => 'OtherIntangibleAssets']);
        $type->accountSubTypes()->create(['name' => 'OtherLongTermInvestments']);
        $type->accountSubTypes()->create(['name' => 'OtherLongTermLoansAndAdvances']);
        $type->accountSubTypes()->create(['name' => 'PrepaymentsAndAccruedIncome']);
        $type->accountSubTypes()->create(['name' => 'ProvisionsNonCurrentAssets']);
    }

    private function seedReceivable($asset)
    {
        $type = $asset->accountTypes()->create(['name' => 'Accounts Receivable']);
        $default = $type->accountSubTypes()->create(['name' => 'AccountsReceivable']);
        $type->update(['default_account_subtype_id' => $default->id]);
    }

    private function seedEquity($equity)
    {
        $type = $equity->accountTypes()->create(['name' => 'Equity']);
        $default = $type->accountSubTypes()->create(['name' => 'OpeningBalanceEquity']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'PartnersEquity']);
        $type->accountSubTypes()->create(['name' => 'RetainedEarnings']);
        $type->accountSubTypes()->create(['name' => 'AccumulatedAdjustment']);
        $type->accountSubTypes()->create(['name' => 'OwnersEquity']);
        $type->accountSubTypes()->create(['name' => 'PaidInCapitalOrSurplus']);
        $type->accountSubTypes()->create(['name' => '​PartnerContributions']);
        $type->accountSubTypes()->create(['name' => 'PartnerDistributions']);
        $type->accountSubTypes()->create(['name' => 'PreferredStock']);
        $type->accountSubTypes()->create(['name' => 'CommonStock']);
        $type->accountSubTypes()->create(['name' => 'TreasuryStock']);
        $type->accountSubTypes()->create(['name' => 'EstimatedTaxes']);
        $type->accountSubTypes()->create(['name' => 'Healthcare']);
        $type->accountSubTypes()->create(['name' => 'PersonalIncome']);
        $type->accountSubTypes()->create(['name' => 'PersonalExpense']);
        $type->accountSubTypes()->create(['name' => 'AccumulatedOtherComprehensiveIncome']);
        $type->accountSubTypes()->create(['name' => 'CalledUpShareCapital']);
        $type->accountSubTypes()->create(['name' => 'CapitalReserves']);
        $type->accountSubTypes()->create(['name' => 'DividendDisbursed']);
        $type->accountSubTypes()->create(['name' => 'EquityInEarningsOfSubsiduaries']);
        $type->accountSubTypes()->create(['name' => 'InvestmentGrants']);
        $type->accountSubTypes()->create(['name' => 'MoneyReceivedAgainstShareWarrants']);
        $type->accountSubTypes()->create(['name' => 'OtherFreeReserves']);
        $type->accountSubTypes()->create(['name' => 'ShareApplicationMoneyPendingAllotment']);
        $type->accountSubTypes()->create(['name' => 'ShareCapital']);
        $type->accountSubTypes()->create(['name' => 'Funds']);
    }

    private function seedExpense($expense)
    {
        $type = $expense->accountTypes()->create(['name' => 'Expense']);
        $type->accountSubTypes()->create(['name' => 'AdvertisingPromotional']);
        $type->accountSubTypes()->create(['name' => 'BadDebts']);
        $type->accountSubTypes()->create(['name' => 'BankCharges']);
        $type->accountSubTypes()->create(['name' => 'CharitableContributions']);
        $type->accountSubTypes()->create(['name' => 'CommissionsAndFees']);
        $type->accountSubTypes()->create(['name' => 'Entertainment']);
        $type->accountSubTypes()->create(['name' => 'EntertainmentMeals']);
        $type->accountSubTypes()->create(['name' => 'EquipmentRental']);
        $type->accountSubTypes()->create(['name' => 'FinanceCosts']);
        $type->accountSubTypes()->create(['name' => 'GlobalTaxExpense']);
        $type->accountSubTypes()->create(['name' => 'Insurance']);
        $type->accountSubTypes()->create(['name' => 'InterestPaid']);
        $type->accountSubTypes()->create(['name' => 'LegalProfessionalFees']);
        $type->accountSubTypes()->create(['name' => 'OfficeExpenses']);
        $type->accountSubTypes()->create(['name' => 'OfficeGeneralAdministrativeExpenses']);
        $type->accountSubTypes()->create(['name' => 'OtherBusinessExpenses']);
        $type->accountSubTypes()->create(['name' => 'OtherMiscellaneousServiceCost']);
        $type->accountSubTypes()->create(['name' => 'PromotionalMeals']);
        $type->accountSubTypes()->create(['name' => 'RentOrLeaseOfBuildings']);
        $type->accountSubTypes()->create(['name' => 'RepairMaintenance']);
        $type->accountSubTypes()->create(['name' => 'ShippingFreightDelivery']);
        $type->accountSubTypes()->create(['name' => 'SuppliesMaterials']);
        $default = $type->accountSubTypes()->create(['name' => 'Travel']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'TravelMeals']);
        $type->accountSubTypes()->create(['name' => 'Utilities']);
        $type->accountSubTypes()->create(['name' => 'Auto']);
        $type->accountSubTypes()->create(['name' => 'CostOfLabor']);
        $type->accountSubTypes()->create(['name' => 'DuesSubscriptions']);
        $type->accountSubTypes()->create(['name' => 'PayrollExpenses']);
        $type->accountSubTypes()->create(['name' => 'TaxesPaid']);
        $type->accountSubTypes()->create(['name' => 'UnappliedCashBillPaymentExpense']);
        $type->accountSubTypes()->create(['name' => 'Utilities']);
        $type->accountSubTypes()->create(['name' => 'AmortizationExpense']);
        $type->accountSubTypes()->create(['name' => 'AppropriationsToDepreciation']);
        $type->accountSubTypes()->create(['name' => 'BorrowingCost']);
        $type->accountSubTypes()->create(['name' => 'CommissionsAndFees']);
        $type->accountSubTypes()->create(['name' => 'DistributionCosts']);
        $type->accountSubTypes()->create(['name' => 'ExternalServices']);
        $type->accountSubTypes()->create(['name' => 'ExtraordinaryCharges']);
        $type->accountSubTypes()->create(['name' => 'IncomeTaxExpense']);
        $type->accountSubTypes()->create(['name' => 'LossOnDiscontinuedOperationsNetOfTax']);
        $type->accountSubTypes()->create(['name' => 'ManagementCompensation']);
        $type->accountSubTypes()->create(['name' => 'OtherCurrentOperatingCharges']);
        $type->accountSubTypes()->create(['name' => 'OtherExternalServices']);
        $type->accountSubTypes()->create(['name' => 'OtherRentalCosts']);
        $type->accountSubTypes()->create(['name' => 'OtherSellingExpenses']);
        $type->accountSubTypes()->create(['name' => 'ProjectStudiesSurveysAssessments']);
        $type->accountSubTypes()->create(['name' => 'PurchasesRebates']);
        $type->accountSubTypes()->create(['name' => 'ShippingAndDeliveryExpense']);
        $type->accountSubTypes()->create(['name' => 'StaffCosts']);
        $type->accountSubTypes()->create(['name' => 'Sundry']);
        $type->accountSubTypes()->create(['name' => 'TravelExpensesGeneralAndAdminExpenses']);
        $type->accountSubTypes()->create(['name' => 'TravelExpensesSellingExpense']);
    }

    private function seedOtherExpense($expense)
    {
        $type = $expense->accountTypes()->create(['name' => 'Other Expense']);
        $default = $type->accountSubTypes()->create(['name' => 'Depreciation']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'ExchangeGainOrLoss']);
        $type->accountSubTypes()->create(['name' => 'OtherMiscellaneousExpense']);
        $type->accountSubTypes()->create(['name' => 'PenaltiesSettlements']);
        $type->accountSubTypes()->create(['name' => 'Amortization']);
        $type->accountSubTypes()->create(['name' => 'GasAndFuel']);
        $type->accountSubTypes()->create(['name' => 'HomeOffice']);
        $type->accountSubTypes()->create(['name' => 'HomeOwnerRentalInsurance']);
        $type->accountSubTypes()->create(['name' => 'OtherHomeOfficeExpenses']);
        $type->accountSubTypes()->create(['name' => 'MortgageInterest']);
        $type->accountSubTypes()->create(['name' => 'RentAndLease']);
        $type->accountSubTypes()->create(['name' => 'RepairsAndMaintenance']);
        $type->accountSubTypes()->create(['name' => 'ParkingAndTolls']);
        $type->accountSubTypes()->create(['name' => 'Vehicle']);
        $type->accountSubTypes()->create(['name' => 'VehicleInsurance']);
        $type->accountSubTypes()->create(['name' => 'VehicleLease']);
        $type->accountSubTypes()->create(['name' => 'VehicleLoanInterest']);
        $type->accountSubTypes()->create(['name' => 'VehicleLoan']);
        $type->accountSubTypes()->create(['name' => 'VehicleRegistration']);
        $type->accountSubTypes()->create(['name' => 'VehicleRepairs']);
        $type->accountSubTypes()->create(['name' => 'OtherVehicleExpenses']);
        $type->accountSubTypes()->create(['name' => 'Utilities']);
        $type->accountSubTypes()->create(['name' => 'WashAndRoadServices']);
        $type->accountSubTypes()->create(['name' => 'DeferredTaxExpense']);
        $type->accountSubTypes()->create(['name' => 'Depletion']);
        $type->accountSubTypes()->create(['name' => 'ExceptionalItems']);
        $type->accountSubTypes()->create(['name' => 'ExtraordinaryItems']);
        $type->accountSubTypes()->create(['name' => 'IncomeTaxOtherExpense']);
        $type->accountSubTypes()->create(['name' => 'MatCredit']);
        $type->accountSubTypes()->create(['name' => 'PriorPeriodItems']);
        $type->accountSubTypes()->create(['name' => 'TaxRoundoffGainOrLoss']);
    }

    private function seedCogs($expense)
    {
        $type = $expense->accountTypes()->create(['name' => 'Cost of Goods Sold']);
        $type->accountSubTypes()->create(['name' => 'EquipmentRentalCos']);
        $type->accountSubTypes()->create(['name' => 'OtherCostsOfServiceCos']);
        $type->accountSubTypes()->create(['name' => 'ShippingFreightDeliveryCos']);
        $type->accountSubTypes()->create(['name' => 'SuppliesMaterialsCogs']);
        $default = $type->accountSubTypes()->create(['name' => 'CostOfLaborCos']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'CostOfSales']);
        $type->accountSubTypes()->create(['name' => 'FreightAndDeliveryCost']);
    }

    private function seedAp($liability)
    {
        $type = $liability->accountTypes()->create(['name' => 'Accounts Payable']);
        $default = $type->accountSubTypes()->create(['name' => 'AccountsPayable']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'OutstandingDuesMicroSmallEnterprise']);
        $type->accountSubTypes()->create(['name' => 'OutstandingDuesOtherThanMicroSmallEnterprise']);
    }

    private function seedCc($liability)
    {
        $type = $liability->accountTypes()->create(['name' => 'Credit Card']);
        $default = $type->accountSubTypes()->create(['name' => 'Credit Card']);
        $type->update(['default_account_subtype_id' => $default->id]);
    }

    private function seedLtLiability($liability)
    {
        $type = $liability->accountTypes()->create(['name' => 'Long Term Liability']);
        $default = $type->accountSubTypes()->create(['name' => 'NotesPayable']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'OtherLongTermLiabilities']);
        $type->accountSubTypes()->create(['name' => 'ShareholderNotesPayable']);
        $type->accountSubTypes()->create(['name' => 'AccrualsAndDeferredIncome']);
        $type->accountSubTypes()->create(['name' => 'AccruedLongLermLiabilities']);
        $type->accountSubTypes()->create(['name' => 'AccruedVacationPayable']);
        $type->accountSubTypes()->create(['name' => 'BankLoans']);
        $type->accountSubTypes()->create(['name' => 'DebtsRelatedToParticipatingInterests']);
        $type->accountSubTypes()->create(['name' => 'DeferredTaxLiabilities']);
        $type->accountSubTypes()->create(['name' => 'GovernmentAndOtherPublicAuthorities']);
        $type->accountSubTypes()->create(['name' => 'GroupAndAssociates']);
        $type->accountSubTypes()->create(['name' => 'LiabilitiesRelatedToAssetsHeldForSale']);
        $type->accountSubTypes()->create(['name' => 'LongTermBorrowings']);
        $type->accountSubTypes()->create(['name' => 'LongTermDebit']);
        $type->accountSubTypes()->create(['name' => 'LongTermEmployeeBenefitObligations']);
        $type->accountSubTypes()->create(['name' => 'ObligationsUnderFinanceLeases']);
        $type->accountSubTypes()->create(['name' => 'OtherLongTermProvisions']);
        $type->accountSubTypes()->create(['name' => 'ProvisionForLiabilities']);
        $type->accountSubTypes()->create(['name' => 'ProvisionsNonCurrentLiabilities']);
        $type->accountSubTypes()->create(['name' => 'StaffAndRelatedLongTermLiabilityAccounts']);
    }

    private function seedOcLiability($liability)
    {
        $type = $liability->accountTypes()->create(['name' => 'Other Current Liability']);
        $type->accountSubTypes()->create(['name' => 'DirectDepositPayable']);
        $type->accountSubTypes()->create(['name' => 'LineOfCredit']);
        $type->accountSubTypes()->create(['name' => 'LoanPayable']);
        $type->accountSubTypes()->create(['name' => 'GlobalTaxPayable']);
        $type->accountSubTypes()->create(['name' => 'GlobalTaxSuspense']);
        $default = $type->accountSubTypes()->create(['name' => 'OtherCurrentLiabilities']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'PayrollClearing']);
        $type->accountSubTypes()->create(['name' => 'PayrollTaxPayable']);
        $type->accountSubTypes()->create(['name' => 'PrepaidExpensesPayable']);
        $type->accountSubTypes()->create(['name' => 'RentsInTrustLiability']);
        $type->accountSubTypes()->create(['name' => 'TrustAccountsLiabilities']);
        $type->accountSubTypes()->create(['name' => 'FederalIncomeTaxPayable']);
        $type->accountSubTypes()->create(['name' => 'InsurancePayable']);
        $type->accountSubTypes()->create(['name' => 'SalesTaxPayable']);
        $type->accountSubTypes()->create(['name' => 'StateLocalIncomeTaxPayable']);
        $type->accountSubTypes()->create(['name' => 'AccruedLiabilities']);
        $type->accountSubTypes()->create(['name' => 'CurrentLiabilities']);
        $type->accountSubTypes()->create(['name' => 'CurrentPortionEmployeeBenefitsObligations']);
        $type->accountSubTypes()->create(['name' => 'CurrentPortionOfObligationsUnderFinanceLeases']);
        $type->accountSubTypes()->create(['name' => 'CurrentTaxLiability']);
        $type->accountSubTypes()->create(['name' => 'DividendsPayable']);
        $type->accountSubTypes()->create(['name' => 'DutiesAndTaxes']);
        $type->accountSubTypes()->create(['name' => 'InterestPayables']);
        $type->accountSubTypes()->create(['name' => 'ProvisionForWarrantyObligations']);
        $type->accountSubTypes()->create(['name' => 'ProvisionsCurrentLiabilities']);
        $type->accountSubTypes()->create(['name' => 'ShortTermBorrowings']);
        $type->accountSubTypes()->create(['name' => 'SocialSecurityAgencies']);
        $type->accountSubTypes()->create(['name' => 'StaffAndRelatedLiabilityAccounts']);
        $type->accountSubTypes()->create(['name' => 'SundryDebtorsAndCreditors']);
        $type->accountSubTypes()->create(['name' => 'TradeAndOtherPayables']);
    }

    private function seedIncome($revenue)
    {
        $type = $revenue->accountTypes()->create(['name' => 'Income']);
        $type->accountSubTypes()->create(['name' => 'NonProfitIncome']);
        $default = $type->accountSubTypes()->create(['name' => 'OtherPrimaryIncome']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'SalesOfProductIncome']);
        $type->accountSubTypes()->create(['name' => 'ServiceFeeIncome']);
        $type->accountSubTypes()->create(['name' => 'DiscountsRefundsGiven']);
        $type->accountSubTypes()->create(['name' => 'UnappliedCashPaymentIncome']);
        $type->accountSubTypes()->create(['name' => 'CashReceiptIncome']);
        $type->accountSubTypes()->create(['name' => 'OperatingGrants']);
        $type->accountSubTypes()->create(['name' => 'OtherCurrentOperatingIncome']);
        $type->accountSubTypes()->create(['name' => 'OwnWorkCapitalized']);
        $type->accountSubTypes()->create(['name' => 'RevenueGeneral']);
        $type->accountSubTypes()->create(['name' => 'SalesRetail']);
        $type->accountSubTypes()->create(['name' => 'SalesWholesale']);
        $type->accountSubTypes()->create(['name' => 'SavingsByTaxScheme']);
    }

    private function seedOIncome($revenue)
    {
        $type = $revenue->accountTypes()->create(['name' => 'Other Income']);
        $type->accountSubTypes()->create(['name' => 'DividendIncome']);
        $type->accountSubTypes()->create(['name' => 'InterestEarned']);
        $default = $type->accountSubTypes()->create(['name' => 'OtherInvestmentIncome']);
        $type->update(['default_account_subtype_id' => $default->id]);
        $type->accountSubTypes()->create(['name' => 'OtherMiscellaneousIncome']);
        $type->accountSubTypes()->create(['name' => 'TaxExemptInterest']);
        $type->accountSubTypes()->create(['name' => 'GainLossOnSaleOfFixedAssets']);
        $type->accountSubTypes()->create(['name' => 'GainLossOnSaleOfInvestments']);
        $type->accountSubTypes()->create(['name' => 'LossOnDisposalOfAssets']);
        $type->accountSubTypes()->create(['name' => 'OtherOperatingIncome']);
        $type->accountSubTypes()->create(['name' => 'UnrealisedLossOnSecuritiesNetOfTax']);
    }
}
