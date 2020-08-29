<?php

use XML\Tests\ {
    TestCase
};
use XML\Finder;

class FinderTest extends TestCase
{
    public function testShouldAny()
    {
$invoice =  <<<'EOT'
<?xml version="1.0" encoding="utf-8" standalone="no"?>
<Invoice
  xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
  xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
  xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
  xmlns:sts="dian:gov:co:facturaelectronica:Structures-2-1"
  xmlns:xades="http://uri.etsi.org/01903/v1.3.2#"
  xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd"
  xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2">
  <ext:UBLExtensions>
    <ext:UBLExtension>
      <ext:ExtensionContent>
        <sts:DianExtensions>
          <sts:InvoiceControl>
            <sts:InvoiceAuthorization>18760000001</sts:InvoiceAuthorization>
            <sts:AuthorizationPeriod>
              <cbc:StartDate>2019-01-19</cbc:StartDate>
              <cbc:EndDate>2030-01-19</cbc:EndDate>
            </sts:AuthorizationPeriod>
            <sts:AuthorizedInvoices>
              <sts:Prefix>SETP</sts:Prefix>
              <sts:From>990000000</sts:From>
              <sts:To>995000000</sts:To>
            </sts:AuthorizedInvoices>
          </sts:InvoiceControl>
          <sts:InvoiceSource>
            <cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1">CO</cbc:IdentificationCode>
          </sts:InvoiceSource>
          <sts:SoftwareProvider>
            <sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31">900643855</sts:ProviderID>
            <sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">67b8d07f-de80-40cf-839e-ffa124aa16c5</sts:SoftwareID>
          </sts:SoftwareProvider>
          <sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">55de4f98103b003ddd7a2e3d3194912dfdcf3fecda24cdfb05d5524b3ae973ff8d5e97fe4f0a7685d959ac8d15bc268d</sts:SoftwareSecurityCode>
          <sts:AuthorizationProvider>
            <sts:AuthorizationProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31">800197268</sts:AuthorizationProviderID>
          </sts:AuthorizationProvider>
          <sts:QRCode>https://catalogo-vpfe-hab.dian.gov.co/document/searchqr?documentkey=96185d03bf457ad168b5ba4a5b99c0e80136bb48590ec8155408135f7a03f2b7f2e665c544c544eff6ff69d6fcf861eb</sts:QRCode>
        </sts:DianExtensions>
      </ext:ExtensionContent>
    </ext:UBLExtension>
    <ext:UBLExtension>
      <ext:ExtensionContent>
        <ds:Signature
          xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="xmldsig-1bfc7ac992c8">
          <ds:SignedInfo>
            <ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
            <ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha512"/>
            <ds:Reference Id="xmldsig-1bfc7ac992c8-ref0" URI="">
              <ds:Transforms>
                <ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
              </ds:Transforms>
              <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
              <ds:DigestValue>Jqo9CoBM94h9hwxZwRloLb38CI7Fd5A3TVUGn3yWxwgSjcTl5D3MpQP6RCwDaAHhOCKbr9h8F6Wsj42JCL5m0A==</ds:DigestValue>
            </ds:Reference>
            <ds:Reference URI="#xmldsig-1bfc7ac992c8-keyinfo">
              <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
              <ds:DigestValue>VbX1yaUaref4r3G7sK4KnubZk1NJiZlH9vLgGYFOCJtxF9YsCjINrStmfHfQmljwlbi2gvsujb51NCoEHMfDyA==</ds:DigestValue>
            </ds:Reference>
            <ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#xmldsig-1bfc7ac992c8-signedprops">
              <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
              <ds:DigestValue>O/5s1nvJjIhNq42i2ZFwy1dmEeu2YN9iUGD2oddF50qmdb9L79XCMecJXt/D7lcXAgMZ7jvSU1W2fO+7R+/P/w==</ds:DigestValue>
            </ds:Reference>
          </ds:SignedInfo>
          <ds:SignatureValue Id="xmldsig-1bfc7ac992c8-sigvalue">K9Lw6RZbAzszJmCX7UbzReLTlWTs1x9YTuKj2PfW3pLGaMnddyIxDB2SPGaPVZGOV+ltB12uTh2eP8p5LpeVpkbyQpC8ZS66QUJSTMZJ+gMlSxefq7i9zpoVjSXB8n6jGYhngeqoSBy/PUgk0QbJ29hDQEZV+hArNrvtr1j0vAB07P171MExAlHKV8gj7Al27RVTAZDC8mRtLmWYT7AVvjv3RtJHs4XMUElC6oqqVrN1Eo2elRzVbkwVsjmiG1dDLrCQNkBmwXh62Ibumyc7BL61V4P5jrgUtvK0o5iKKvTZ9jbAE28XBplmnUvERiEDrlc5MFcJ9XXCIpYT9iLE4g==</ds:SignatureValue>
          <ds:KeyInfo Id="xmldsig-1bfc7ac992c8-keyinfo">
            <ds:X509Data>
              <ds:X509Certificate>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</ds:X509Certificate>
            </ds:X509Data>
          </ds:KeyInfo>
          <ds:Object>
            <xades:QualifyingProperties
              xmlns:xades="http://uri.etsi.org/01903/v1.3.2#"
              xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
              xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" Target="#xmldsig-1bfc7ac992c8">
              <xades:SignedProperties Id="xmldsig-1bfc7ac992c8-signedprops">
                <xades:SignedSignatureProperties>
                  <xades:SigningTime>2019-12-19T09:41:19-05:00</xades:SigningTime>
                  <xades:SigningCertificate>
                    <xades:Cert>
                      <xades:CertDigest>
                        <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
                        <ds:DigestValue>4pUfz78L3e4XXzviNjD5/kZo88AA8schrX/ezmbzmpOTIUcA2sBIqJdd+ftJQaqCCPsamw9+SmM1pJepGxawaQ==</ds:DigestValue>
                      </xades:CertDigest>
                      <xades:IssuerSerial>
                        <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion entidad final,CN=CA ANDES SCD S.A. Clase II v2,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                        <ds:X509SerialNumber>4536440003607546127</ds:X509SerialNumber>
                      </xades:IssuerSerial>
                    </xades:Cert>
                    <xades:Cert>
                      <xades:CertDigest>
                        <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
                        <ds:DigestValue>4pUfz78L3e4XXzviNjD5/kZo88AA8schrX/ezmbzmpOTIUcA2sBIqJdd+ftJQaqCCPsamw9+SmM1pJepGxawaQ==</ds:DigestValue>
                      </xades:CertDigest>
                      <xades:IssuerSerial>
                        <ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion entidad final,CN=CA ANDES SCD S.A. Clase II v2,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
                        <ds:X509SerialNumber>4536440003607546127</ds:X509SerialNumber>
                      </xades:IssuerSerial>
                    </xades:Cert>
                  </xades:SigningCertificate>
                  <xades:SignaturePolicyIdentifier>
                    <xades:SignaturePolicyId>
                      <xades:SigPolicyId>
                        <xades:Identifier>https://facturaelectronica.dian.gov.co/politicadefirma/v2/politicadefirmav2.pdf</xades:Identifier>
                      </xades:SigPolicyId>
                      <xades:SigPolicyHash>
                        <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
                        <ds:DigestValue>Zcjw1Z9nGQn2j6NyGx8kAaLbOfJGd/fJxRTCeirlqAg7zRG27piJkJOpflGu7XACpMj9hC6dVMcCyzqHxxPZeQ==</ds:DigestValue>
                      </xades:SigPolicyHash>
                    </xades:SignaturePolicyId>
                  </xades:SignaturePolicyIdentifier>
                  <xades:SignerRole>
                    <xades:ClaimedRoles>
                      <xades:ClaimedRole>supplier</xades:ClaimedRole>
                    </xades:ClaimedRoles>
                  </xades:SignerRole>
                </xades:SignedSignatureProperties>
              </xades:SignedProperties>
            </xades:QualifyingProperties>
          </ds:Object>
        </ds:Signature>
      </ext:ExtensionContent>
    </ext:UBLExtension>
  </ext:UBLExtensions>
  <cbc:UBLVersionID>UBL 2.1</cbc:UBLVersionID>
  <cbc:CustomizationID>10</cbc:CustomizationID>
  <cbc:ProfileID>DIAN 2.1</cbc:ProfileID>
  <cbc:ProfileExecutionID>2</cbc:ProfileExecutionID>
  <cbc:ID>SETP990000059</cbc:ID>
  <cbc:UUID schemeID="2" schemeName="CUFE-SHA384">96185d03bf457ad168b5ba4a5b99c0e80136bb48590ec8155408135f7a03f2b7f2e665c544c544eff6ff69d6fcf861eb</cbc:UUID>
  <cbc:IssueDate>2019-12-09</cbc:IssueDate>
  <cbc:IssueTime>11:22:28-05:00</cbc:IssueTime>
  <cbc:InvoiceTypeCode>01</cbc:InvoiceTypeCode>
  <cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode>
  <cbc:LineCountNumeric>2</cbc:LineCountNumeric>
  <cac:AccountingSupplierParty>
    <cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>
    <cac:Party>
      <cac:PhysicalLocation>
        <cac:Address>
          <cbc:ID>11001</cbc:ID>
          <cbc:CityName>Bogotá, D.c.</cbc:CityName>
          <cbc:CountrySubentity>Bogotá</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>11</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>Kr 79 No. 127C - 45 IN 2 AP 101</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode>CO</cbc:IdentificationCode>
            <cbc:Name languageID="es">Colombia</cbc:Name>
          </cac:Country>
        </cac:Address>
      </cac:PhysicalLocation>
      <cac:PartyTaxScheme>
        <cbc:RegistrationName>Miguel Uribe Mv Sas</cbc:RegistrationName>
        <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31">900643855</cbc:CompanyID>
        <cbc:TaxLevelCode listName="48">ZZ</cbc:TaxLevelCode>
        <cac:RegistrationAddress>
          <cbc:ID>11001</cbc:ID>
          <cbc:CityName>Bogotá, D.c.</cbc:CityName>
          <cbc:CountrySubentity>Bogotá</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>11</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>Kr 79 No. 127C - 45 IN 2 AP 101</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode>CO</cbc:IdentificationCode>
            <cbc:Name languageID="es">Colombia</cbc:Name>
          </cac:Country>
        </cac:RegistrationAddress>
        <cac:TaxScheme>
          <cbc:ID>01</cbc:ID>
          <cbc:Name>IVA</cbc:Name>
        </cac:TaxScheme>
      </cac:PartyTaxScheme>
      <cac:PartyLegalEntity>
        <cbc:RegistrationName>Miguel Uribe Mv Sas</cbc:RegistrationName>
        <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31">900643855</cbc:CompanyID>
        <cac:CorporateRegistrationScheme>
          <cbc:ID>SETP</cbc:ID>
        </cac:CorporateRegistrationScheme>
      </cac:PartyLegalEntity>
      <cac:Contact>
        <cbc:Telephone>3507986866</cbc:Telephone>
        <cbc:ElectronicMail>migueluribemv@gmail.com</cbc:ElectronicMail>
      </cac:Contact>
    </cac:Party>
  </cac:AccountingSupplierParty>
  <cac:AccountingCustomerParty>
    <cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>
    <cac:Party>
      <cac:PhysicalLocation>
        <cac:Address>
          <cbc:ID>11001</cbc:ID>
          <cbc:CityName>Bogotá, D.c.</cbc:CityName>
          <cbc:CountrySubentity>Bogotá</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>11</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>Cll 93B 17 - 25 Piso 6 Edif. Centro Internacional de Negocios</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode>CO</cbc:IdentificationCode>
            <cbc:Name languageID="es">Colombia</cbc:Name>
          </cac:Country>
        </cac:Address>
      </cac:PhysicalLocation>
      <cac:PartyTaxScheme>
        <cbc:RegistrationName>Ike Asistencia Colombia</cbc:RegistrationName>
        <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="3" schemeName="31">900106251</cbc:CompanyID>
        <cbc:TaxLevelCode listName="49">ZZ</cbc:TaxLevelCode>
        <cac:RegistrationAddress>
          <cbc:ID>11001</cbc:ID>
          <cbc:CityName>Bogotá, D.c.</cbc:CityName>
          <cbc:CountrySubentity>Bogotá</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>11</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>Cll 93B 17 - 25 Piso 6 Edif. Centro Internacional de Negocios</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode>CO</cbc:IdentificationCode>
            <cbc:Name languageID="es">Colombia</cbc:Name>
          </cac:Country>
        </cac:RegistrationAddress>
        <cac:TaxScheme>
          <cbc:ID>ZZ</cbc:ID>
          <cbc:Name>Nombre de la figura tributaria</cbc:Name>
        </cac:TaxScheme>
      </cac:PartyTaxScheme>
      <cac:PartyLegalEntity>
        <cbc:RegistrationName>Ike Asistencia Colombia</cbc:RegistrationName>
        <cbc:CompanyID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="3" schemeName="31">900106251</cbc:CompanyID>
      </cac:PartyLegalEntity>
      <cac:Contact>
        <cbc:Telephone>6337735</cbc:Telephone>
        <cbc:ElectronicMail>loduis@gmail.com</cbc:ElectronicMail>
      </cac:Contact>
    </cac:Party>
  </cac:AccountingCustomerParty>
  <cac:PaymentMeans>
    <cbc:ID>2</cbc:ID>
    <cbc:PaymentMeansCode>1</cbc:PaymentMeansCode>
    <cbc:PaymentDueDate>2020-01-08</cbc:PaymentDueDate>
    <cbc:PaymentID>1</cbc:PaymentID>
  </cac:PaymentMeans>
  <cac:TaxTotal>
    <cbc:TaxAmount currencyID="COP">17480.00</cbc:TaxAmount>
    <cac:TaxSubtotal>
      <cbc:TaxableAmount currencyID="COP">92000.00</cbc:TaxableAmount>
      <cbc:TaxAmount currencyID="COP">17480.00</cbc:TaxAmount>
      <cac:TaxCategory>
        <cbc:Percent>19</cbc:Percent>
        <cac:TaxScheme>
          <cbc:ID>01</cbc:ID>
          <cbc:Name>IVA</cbc:Name>
        </cac:TaxScheme>
      </cac:TaxCategory>
    </cac:TaxSubtotal>
  </cac:TaxTotal>
  <cac:WithholdingTaxTotal>
    <cbc:TaxAmount currencyID="COP">10120.00</cbc:TaxAmount>
    <cac:TaxSubtotal>
      <cbc:TaxableAmount currencyID="COP">92000.00</cbc:TaxableAmount>
      <cbc:TaxAmount currencyID="COP">10120.00</cbc:TaxAmount>
      <cac:TaxCategory>
        <cbc:Percent>11</cbc:Percent>
        <cac:TaxScheme>
          <cbc:ID>06</cbc:ID>
          <cbc:Name>ReteRenta</cbc:Name>
        </cac:TaxScheme>
      </cac:TaxCategory>
    </cac:TaxSubtotal>
  </cac:WithholdingTaxTotal>
  <cac:WithholdingTaxTotal>
    <cbc:TaxAmount currencyID="COP">889.00</cbc:TaxAmount>
    <cac:TaxSubtotal>
      <cbc:TaxableAmount currencyID="COP">92000.00</cbc:TaxableAmount>
      <cbc:TaxAmount currencyID="COP">889.00</cbc:TaxAmount>
      <cac:TaxCategory>
        <cbc:Percent>0.966</cbc:Percent>
        <cac:TaxScheme>
          <cbc:ID>07</cbc:ID>
          <cbc:Name>ReteICA</cbc:Name>
        </cac:TaxScheme>
      </cac:TaxCategory>
    </cac:TaxSubtotal>
  </cac:WithholdingTaxTotal>
  <cac:LegalMonetaryTotal>
    <cbc:LineExtensionAmount currencyID="COP">92000.00</cbc:LineExtensionAmount>
    <cbc:TaxExclusiveAmount currencyID="COP">92000.00</cbc:TaxExclusiveAmount>
    <cbc:TaxInclusiveAmount currencyID="COP">109480.00</cbc:TaxInclusiveAmount>
    <cbc:PayableAmount currencyID="COP">109480.00</cbc:PayableAmount>
  </cac:LegalMonetaryTotal>
  <cac:InvoiceLine>
    <cbc:ID>1</cbc:ID>
    <cbc:InvoicedQuantity>1</cbc:InvoicedQuantity>
    <cbc:LineExtensionAmount currencyID="COP">12000.00</cbc:LineExtensionAmount>
    <cac:TaxTotal>
      <cbc:TaxAmount currencyID="COP">2280.00</cbc:TaxAmount>
      <cac:TaxSubtotal>
        <cbc:TaxableAmount currencyID="COP">12000.00</cbc:TaxableAmount>
        <cbc:TaxAmount currencyID="COP">2280.00</cbc:TaxAmount>
        <cac:TaxCategory>
          <cbc:Percent>19</cbc:Percent>
          <cac:TaxScheme>
            <cbc:ID>01</cbc:ID>
            <cbc:Name>IVA</cbc:Name>
          </cac:TaxScheme>
        </cac:TaxCategory>
      </cac:TaxSubtotal>
    </cac:TaxTotal>
    <cac:WithholdingTaxTotal>
      <cbc:TaxAmount currencyID="COP">1320.00</cbc:TaxAmount>
      <cac:TaxSubtotal>
        <cbc:TaxableAmount currencyID="COP">12000.00</cbc:TaxableAmount>
        <cbc:TaxAmount currencyID="COP">1320.00</cbc:TaxAmount>
        <cac:TaxCategory>
          <cbc:Percent>11</cbc:Percent>
          <cac:TaxScheme>
            <cbc:ID>06</cbc:ID>
            <cbc:Name>ReteRenta</cbc:Name>
          </cac:TaxScheme>
        </cac:TaxCategory>
      </cac:TaxSubtotal>
    </cac:WithholdingTaxTotal>
    <cac:Item>
      <cbc:Description>Orientación médico veterinaria telefónica</cbc:Description>
    </cac:Item>
    <cac:Price>
      <cbc:PriceAmount currencyID="COP">12000.00</cbc:PriceAmount>
      <cbc:BaseQuantity unitCode="NIU">1</cbc:BaseQuantity>
    </cac:Price>
  </cac:InvoiceLine>
  <cac:InvoiceLine>
    <cbc:ID>2</cbc:ID>
    <cbc:InvoicedQuantity>1</cbc:InvoicedQuantity>
    <cbc:LineExtensionAmount currencyID="COP">80000.00</cbc:LineExtensionAmount>
    <cac:TaxTotal>
      <cbc:TaxAmount currencyID="COP">15200.00</cbc:TaxAmount>
      <cac:TaxSubtotal>
        <cbc:TaxableAmount currencyID="COP">80000.00</cbc:TaxableAmount>
        <cbc:TaxAmount currencyID="COP">15200.00</cbc:TaxAmount>
        <cac:TaxCategory>
          <cbc:Percent>19</cbc:Percent>
          <cac:TaxScheme>
            <cbc:ID>01</cbc:ID>
            <cbc:Name>IVA</cbc:Name>
          </cac:TaxScheme>
        </cac:TaxCategory>
      </cac:TaxSubtotal>
    </cac:TaxTotal>
    <cac:WithholdingTaxTotal>
      <cbc:TaxAmount currencyID="COP">8800.00</cbc:TaxAmount>
      <cac:TaxSubtotal>
        <cbc:TaxableAmount currencyID="COP">80000.00</cbc:TaxableAmount>
        <cbc:TaxAmount currencyID="COP">8800.00</cbc:TaxAmount>
        <cac:TaxCategory>
          <cbc:Percent>11</cbc:Percent>
          <cac:TaxScheme>
            <cbc:ID>06</cbc:ID>
            <cbc:Name>ReteRenta</cbc:Name>
          </cac:TaxScheme>
        </cac:TaxCategory>
      </cac:TaxSubtotal>
    </cac:WithholdingTaxTotal>
    <cac:Item>
      <cbc:Description>Consulta médica veterinaria presencial</cbc:Description>
    </cac:Item>
    <cac:Price>
      <cbc:PriceAmount currencyID="COP">80000.00</cbc:PriceAmount>
      <cbc:BaseQuantity unitCode="NIU">1</cbc:BaseQuantity>
    </cac:Price>
  </cac:InvoiceLine>
</Invoice>
EOT;
$response = <<<'EOT'
<?xml version="1.0" encoding="UTF-8"?>
<s:Envelope xmlns:s="http://www.w3.org/2003/05/soap-envelope" xmlns:a="http://www.w3.org/2005/08/addressing" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
   <s:Header>
      <a:Action s:mustUnderstand="1">http://wcf.dian.colombia/IWcfDianCustomerServices/GetNumberingRangeResponse</a:Action>
      <o:Security xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" s:mustUnderstand="1">
         <u:Timestamp u:Id="_0">
            <u:Created>2020-08-22T16:39:25.187Z</u:Created>
            <u:Expires>2020-08-22T16:44:25.187Z</u:Expires>
         </u:Timestamp>
      </o:Security>
   </s:Header>
   <s:Body>
      <GetNumberingRangeResponse xmlns="http://wcf.dian.colombia">
         <GetNumberingRangeResult xmlns:b="http://schemas.datacontract.org/2004/07/NumberRangeResponseList" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
            <b:OperationCode>100</b:OperationCode>
            <b:OperationDescription>Acción completada OK.</b:OperationDescription>
            <b:ResponseList xmlns:c="http://schemas.datacontract.org/2004/07/NumberRangeResponse">
               <c:NumberRangeResponse>
                  <c:ResolutionNumber>1</c:ResolutionNumber>
                  <c:ResolutionDate>2020-08-10</c:ResolutionDate>
                  <c:Prefix>FE</c:Prefix>
                  <c:FromNumber>1</c:FromNumber>
                  <c:ToNumber>3000</c:ToNumber>
                  <c:ValidDateFrom>2020-08-10</c:ValidDateFrom>
                  <c:ValidDateTo>2021-08-10</c:ValidDateTo>
                  <c:TechnicalKey>1</c:TechnicalKey>
               </c:NumberRangeResponse>
            </b:ResponseList>
         </GetNumberingRangeResult>
      </GetNumberingRangeResponse>
   </s:Body>
</s:Envelope>
EOT;

        $finder = new Finder($invoice);
        $this->assertSame('SETP990000059', $finder->text('cbc:ID'));
        $lines = $finder->all('cac:InvoiceLine');
        $this->assertCount(2, $lines);
        $ids = [];
        foreach ($lines as $line) {
            $f2 = Finder::create($line);
            $ids[] = $f2->number('cbc:ID');
        }
        $this->assertContains(1, $ids);
        $this->assertContains(2, $ids);
        $f3 = $finder->new('cac:LegalMonetaryTotal');
        $this->assertEquals('92000.00', $f3->text('cbc:LineExtensionAmount'));
        $f5 = Finder::create($response, [
            'rs' => 'http://wcf.dian.colombia'
        ]);
        $res = $f5->new('s:Body/rs:GetNumberingRangeResponse/rs:GetNumberingRangeResult', [
          'b' => 'http://schemas.datacontract.org/2004/07/NumberRangeResponseList',
          'c' => 'http://schemas.datacontract.org/2004/07/NumberRangeResponse'
        ]);
        $this->assertEquals(100, $res->number('b:OperationCode'));
        $this->assertEquals('Acción completada OK.', $res->text('b:OperationDescription'));
        foreach ($res->all('b:ResponseList/c:NumberRangeResponse') as $node) {
            $entry = $res->new($node);
            $this->assertEquals('FE', $entry->text('c:Prefix'));
        }
    }
}
